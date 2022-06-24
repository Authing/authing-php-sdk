<?php

/**
 * 命名空间
 */

namespace Authing;

/**
 * 导入
 */

require_once "util/Tool.php";
require_once "util/JWT.php";

/**
 * AuthenticationClient
 */

class AuthenticationClient
{
    //数据
    private $_option;
    //域名
    private $_host;
    //JWKS
    private $_jwks;

    /**
     * 构造函数
     * @param array $option 必须，用于传递参数，如 array("email" => "main@test.com")
     * @param string appId 必须，应用 ID
     * @param string appSecret 必须，应用 Secret
     * @param string host 必须，应用对应的用户池域名，例如 pool.authing.cn
     * @param string redirectUri 必须，认证完成后的重定向目标 URL
     * @param string logoutRedirectUri 可选，登出完成后的重定向目标 URL
     * @param string scope 可选，应用侧向 Authing 请求的权限，以空格分隔，默认为 "openid profile"，成功获取的权限会出现在 Access Token 的 scope 字段中，例如 openid（OIDC 标准规定的权限，必须包含）、profile（获取用户的基本身份信息）、offline_access（获取用户的 Refresh Token，可用于调用 refreshLoginState 刷新用户的登录态）
     * @param string serverJWKS 可选，服务端的 JWKS 公钥，用于验证 Token 签名，默认会通过网络请求从服务端的 JWKS 端点自动获取
     * @param string cookieKey 可选，存储认证上下文的 Cookie 名称
     */
    public function __construct($option)
    {
        $option["cookieKey"] = Util\Tool::getNotEmpty($option["cookieKey"], "X-Authing-Node-OIDC-State");
        $option["scope"] = Util\Tool::getNotEmpty($option["scope"], "openid profile");

        if (isset($option["scope"]) and strpos($option["scope"], "openid") === false) {
            throw new \Exception("scope 中必须包含 openid");
        }

        $this->_option = $option;
        $this->_host = $this->_domainC14n($option["host"]);

        if ($option["serverJWKS"]) {
            $this->_jwks = $this->_parseJWKS($option["serverJWKS"]);
        } else {
            $varReq = $this->_requests($this->_host . "/oidc/.well-known/jwks.json");
            if ($varReq["error"]) {
                throw new \Exception("自动获取认证服务器 JWKS 公钥失败, 请检查域名是否正确, 或手动指定 serverJWKS 参数: " . $varReq["error"]);
            }
            $this->_jwks = $this->_parseJWKS($varReq["body"]);
        }
    }

    /**
     * 构造请求
     */
    private function _requests($parMethod, $parGet = [], $parPost = [], $parHeader = [])
    {
        //处理
        if ($parGet != []) $parGet = Util\Tool::formatData($parGet);
        if ($parPost != []) $parPost = Util\Tool::formatData($parPost);
        //头部
        $varHeader = array(
            "Content-Type" => "application/x-www-form-urlencoded",
            "x-authing-request-from" => "SDK",
            "x-authing-sdk-version" => "php:" . phpversion(),
        );
        $varHeader = array_merge($varHeader, $parHeader);
        //请求
        $varReq = Util\Tool::request($this->_url . $parMethod, $parGet, $parPost, $varHeader);
        return $varReq;
    }

    /**
     * 域名标准化
     */
    private static function _domainC14n($domain)
    {
        if (strpos($domain, "http://localhost:") === 0 or strpos($domain, "localhost:") === 0) {
            return $domain;
        }
        preg_match("/^(((?:http)|(?:https)):\/\/)?((?:[\w\-_]+)(?:\.[\w\-_]+)+)(:\d{1,6})?(?:\/.*)?$/", $domain, $matchRes);
        if ($matchRes && $matchRes[3]) {
            $tempA = Util\Tool::getNotEmpty($matchRes[1], "https://");
            $tempB = $matchRes[4] ? "" : $matchRes[4];
            return $tempA . $matchRes[3] . $tempB;
        }
        throw new \Exception("无效的域名配置: " . $domain);
    }

    /**
     * 解析 JWKS
     */
    private static function _parseJWKS($jwks)
    {
        return Util\JWT::parseJWKS($jwks);
    }

    /**
     * 拼接处理 query 参数
     */
    private static function _createQueryParams($params)
    {
        if (empty($params)) return "";
        foreach ($params as $forKey => $forValue) {
            if (is_array($forValue)) {
                foreach ($forValue as $forValues) {
                    $varParams[] = "$forKey=$forValues";
                }
            } else {
                $varParams[] = "$forKey=$forValue";
            }
        }
        return implode("&", $varParams);
    }

    /**
     * 拼接处理 query 参数
     */
    private static function _generateRandomString($length = 30)
    {
        $result = "";
        $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $charactersLength = strlen($characters);
        for ($i = 0; $i < $length; $i++) {
            $result .= substr($characters, floor(rand(1, 10) / 10 * $charactersLength), 1);
        }
        return $result;
    }

    /**
     * 将用户浏览器重定向到 Authing 的认证发起 URL 进行认证，利用 Cookie 将上下文信息传递到应用回调端点
     * @param string $scope 可选，应用侧向 Authing 请求的权限，覆盖初始化参数中的对应设置
     * @param string $state 可选，中间状态标识符，默认自动生成
     * @param string $nonce 可选，出现在 ID Token 中的随机字符串，默认自动生成
     * @param string $redirectUri 可选，回调地址，覆盖初始化参数中的对应设置
     * @param boolean $forced 可选，即便用户已经登录也强制显示登录页
     */
    public function loginWithRedirect($scope = null, $state = null, $nonce = null, $redirectUri = null, $forced = null)
    {
        $res = $this->buildAuthUrl(
            Util\Tool::getNotEmpty($scope),
            Util\Tool::getNotEmpty($state),
            Util\Tool::getNotEmpty($nonce),
            Util\Tool::getNotEmpty($redirectUri),
            Util\Tool::getNotEmpty($forced)
        );

        $tx = array(
            "state" => $res["state"],
            "nonce" => $res["nonce"],
            "redirectUri" => Util\Tool::getNotEmpty($redirectUri, $this->_option["redirectUri"]),
        );

        $ret["cookie"] = $this->_option["cookieKey"] . "=" . Util\JWT::base64UrlEncode(json_encode($tx)) . "; HttpOnly; SameSite=Lax";
        $ret["url"] = $res["url"];

        header("Set-Cookie:" . $ret["cookie"]);
        header("Location:" . $ret["url"]);

        return $ret;
    }

    /**
     * 生成认证发起 URL
     * @param string $scope 可选，本次认证中请求获得的权限，覆盖初始化参数中的对应设置
     * @param string $state 可选，中间状态标识符，默认自动生成
     * @param string $nonce 可选，出现在 ID Token 中的随机字符串，默认自动生成
     * @param string $redirectUri 可选，回调地址，覆盖初始化参数中的对应设置
     * @param boolean $forced 可选，即便用户已经登录也强制显示登录页
     */
    public function buildAuthUrl($scope = null, $state = null, $nonce = null, $redirectUri = null, $forced = null)
    {
        $state = Util\Tool::getNotEmpty($state, $this->_generateRandomString(16));
        $nonce = Util\Tool::getNotEmpty($nonce, $this->_generateRandomString(16));
        $scope = Util\Tool::getNotEmpty($scope, $this->_option["scope"]);

        $params = array(
            "redirect_uri" => Util\Tool::getNotEmpty($redirectUri, $this->_option["redirectUri"]),
            "response_mode" => "query",
            "response_type" => "code",
            "client_id" => $this->_option["appId"],
            "scope" => $scope,
            "state" => $state,
            "nonce" => $nonce,
        );

        if ($forced) {
            $params["prompt"] = "login";
        } else if (in_array("offline_access", explode(" ", $scope))) {
            $params["prompt"] = "consent";
        }

        return array(
            "url" => $this->_host . "/oidc/auth?" . $this->_createQueryParams($params),
            "state" => $state,
            "nonce" => $nonce,
        );
    }

    /**
     * 在应用回调端点处理认证返回结果，利用 Cookie 中传递的上下文信息进行安全验证，并获取用户登录态
     * @param string $url url
     * @param string $cookie cookie
     */
    public function handleRedirectCallback($url, $cookie)
    {
        $url = "http://dummy" . $url;
        $error = Util\Tool::getUrlParam($url, "error");
        if ($error) {
            throw new \Exception("认证服务器返回错误 " . $error . ":" . Util\Tool::getUrlParam($url, "error_description"));
        }

        $code = Util\Tool::getUrlParam($url, "code");
        if (!$code) {
            throw new \Exception("认证服务器未返回授权码");
        }

        $cookieKey = $this->_option["cookieKey"] . "=";
        $txStr = $cookie;
        $txStr = explode("; ", $txStr);
        foreach ($txStr as $forValue) {
            if (substr($forValue, 0, strlen($cookieKey)) === $cookieKey) {
                $txStr = substr($forValue, strlen($cookieKey));
            }
        }

        if (!$txStr) {
            throw new \Exception("Cookie 中没有中间态，认证失败");
        }

        $tx = json_decode((Util\JWT::base64UrlDecode($txStr)), true);
        header("Set-Cookie:" . $this->_option["cookieKey"] . "=;  HttpOnly; SameSite=Lax; Max-Age=0");

        $state = Util\Tool::getUrlParam($url, "state");
        if ($state !== $tx["state"]) {
            throw new \Exception("state 验证失败");
        }

        $loginState = $this->getLoginStateByAuthCode($code, $tx["redirectUri"]);
        if ($loginState["parsedIDToken"]["nonce"] !== $tx["nonce"]) {
            throw new \Exception("nonce 校验失败");
        }

        return $loginState;
    }

    /**
     * 用授权码获取用户登录态
     * @param string $code 必须，Authing 返回的授权码
     * @param string $redirectUri 必须，发起认证时传入的回调地址
     */
    public function getLoginStateByAuthCode($code, $redirectUri)
    {
        $tokenParam = array(
            "code" => $code,
            "client_id" => $this->_option["appId"],
            "client_secret" => $this->_option["appSecret"],
            "redirect_uri" => $redirectUri,
            "grant_type" => "authorization_code",
        );
        $varReq = $this->_requests($this->_host . "/oidc/token", null, $tokenParam);
        return $this->buildLoginState($varReq["body"]);
    }

    /**
     * 验证并解析 Access Token
     * @param string $token 必须，Access Token
     */
    public function parseAccessToken($token)
    {
        $res = Util\JWT::verifyToken($token, $this->_jwks[0]["key"]);
        if ($res === false) {
            throw new \Exception("校验不通过");
        }
        return $res;
    }

    /**
     * 验证并解析 ID Token
     * @param string $token 必须，ID Token
     */
    public function parseIDToken($token)
    {
        $res = Util\JWT::verifyToken($token, $this->_jwks[0]["key"]);
        if ($res === false) {
            throw new \Exception("校验不通过");
        }
        return $res;
    }

    /**
     * 用 Access Token 获取用户身份信息
     * @param string $accessToken 必须，Access Token
     */
    public function getUserInfo($accessToken)
    {
        $varReq = $this->_requests($this->_host . "/oidc/me", null, null, array("Authorization" => "Bearer " . $accessToken));
        return $varReq["body"];
    }

    /**
     * 用 Refresh Token 刷新用户的登录态，延长过期时间，为了获取 Refresh Token，需要在 scope 参数中加入 offline_access
     * @param string $refreshToken 必须，Refresh Token
     */
    public function refreshLoginState($refreshToken)
    {
        $tokenParam = array(
            "client_id" => $this->_option["appId"],
            "client_secret" => $this->_option["appSecret"],
            "refresh_token" => $refreshToken,
            "grant_type" => "refresh_token",
        );
        $varReq = $this->_requests($this->_host . "/oidc/token", null, $tokenParam);
        return $this->buildLoginState($varReq["body"]);
    }

    /**
     * 将浏览器重定向到 Authing 的登出发起 URL 进行登出
     * @param string $idToken 可选，用户登录时获取的 ID Token，用于无效化用户 Token，建议传入
     * @param string $redirectUri 可选，登出完成后的重定向目标 URL，覆盖初始化参数中的对应设置
     * @param string $state 可选，传递到目标 URL 的中间状态标识符
     */
    public function logoutWithRedirect($idToken = null, $redirectUri = null, $state = null)
    {
        $option = array(
            "idToken" => Util\Tool::getNotEmpty($idToken),
            "redirectUri" => Util\Tool::getNotEmpty($redirectUri),
            "state" => Util\Tool::getNotEmpty($state),
        );

        header("Location:" . $this->buildLogoutUrl($option["idToken"], $option["redirectUri"], $option["state"]), true, 302);

        return $option;
    }

    /**
     * 生成登出 URL
     * @param string $idToken 可选，用户登录时获取的 ID Token，用于无效化用户 Token，建议传入
     * @param string $redirectUri 可选，登出完成后的重定向目标 URL，覆盖初始化参数中的对应设置
     * @param string $state 可选，传递到目标 URL 的中间状态标识符
     */
    public function buildLogoutUrl($idToken = null, $redirectUri = null, $state = null)
    {
        $redirectUri = Util\Tool::getNotEmpty($redirectUri, $this->_option["logoutRedirectUri"]);
        if ($redirectUri) {
            $params = array(
                "redirectUri" => $redirectUri,
                "id_token_hint" => $idToken,
            );
        } else {
            $params = array(
                "post_logout_redirect_uri" => $redirectUri,
                "state" => $state,
                "id_token_hint" => $idToken,
            );
        }
        $params = Util\Tool::formatData($params);
        return $this->_host . "/oidc/session/end?" . $this->_createQueryParams($params);
    }

    /**
     * 生成登录状态
     * @param array $tokenRes 必须，tokenRes
     */
    private function buildLoginState($tokenRes)
    {
        return array(
            "accessToken" => $tokenRes["access_token"],
            "idToken" => $tokenRes["id_token"],
            "refreshToken" => $tokenRes["refresh_token"],
            "expireAt" => $tokenRes["expires_in"],
            "parsedIDToken" => $this->parseIDToken($tokenRes["id_token"]),
            "parsedAccessToken" => $this->parseAccessToken($tokenRes["access_token"]),
        );
    }
}
