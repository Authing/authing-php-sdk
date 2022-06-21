<?php

/**
 * 命名空间
 */

namespace Authing;


/**
 * 导入
 */

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
        $option["cookieKey"] = empty($option["cookieKey"]) ? "X-Authing-Node-OIDC-State" : $option["cookieKey"];
        $option["scope"] = empty($option["scope"]) ? "openid profile" : $option["scope"];

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
     * 是否为JSON数据
     */
    private static function _isJson($parString)
    {
        json_decode($parString);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * 规范数据
     */
    private static function _formatData($varData)
    {
        foreach ($varData as $forKey => $forValue) {
            if ($forValue === null) {
                unset($varData[$forKey]);
            }
        }
        return $varData;
    }

    /**
     * 规范数据
     */
    private static function _getUrlParam($parUrl, $parKey)
    {
        $varRes = substr($parUrl, strripos($parUrl, "?") + 1);
        $varRes = explode("&", $varRes);
        foreach ($varRes as $forValue) {
            list($listKey, $listValue) = explode("=", $forValue);
            $varRet[$listKey] = $listValue;
        }
        return isset($varRet[$parKey]) ? $varRet[$parKey] : "";
    }

    /**
     * 请求HTTP
     */
    private static function _request($parUrl, $parGet = [], $parPost = [], $parHeader = [], $parCookie = [])
    {
        //配置-其他
        $varCurlObject = curl_init();
        curl_setopt($varCurlObject, CURLOPT_URL, $parUrl); //配置URL
        curl_setopt($varCurlObject, CURLOPT_CONNECTTIMEOUT, 20); //连接前等待时间
        curl_setopt($varCurlObject, CURLOPT_TIMEOUT, 60); //连接后等待时间
        curl_setopt($varCurlObject, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4); //使用IPv4协议
        curl_setopt($varCurlObject, CURLOPT_RETURNTRANSFER, true); //获取的信息以文件流的形式返回
        curl_setopt($varCurlObject, CURLOPT_HEADER, true); //返回Header
        curl_setopt($varCurlObject, CURLOPT_ENCODING, ""); //支持所有编码
        curl_setopt($varCurlObject, CURLOPT_FOLLOWLOCATION, true); //跟踪爬取重定向页面
        curl_setopt($varCurlObject, CURLOPT_MAXREDIRS, 10); //指定重定向的最大值
        curl_setopt($varCurlObject, CURLOPT_AUTOREFERER, true); // 自动配置Referer
        curl_setopt($varCurlObject, CURLOPT_SSL_VERIFYPEER, false); //禁止验证对等证书
        curl_setopt($varCurlObject, CURLOPT_SSL_VERIFYHOST, false); //禁止检测域名与证书是否一致
        curl_setopt($varCurlObject, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)"); //配置UserAgent
        //配置-Get
        if ($parGet != []) {
            foreach ($parGet as $forKey => $forValue) {
                if (is_array($forValue)) {
                    foreach ($forValue as $forValues) {
                        $varGet[] = "$forKey=$forValues";
                    }
                } else {
                    $varGet[] = "$forKey=$forValue";
                }
            }
            curl_setopt($varCurlObject, CURLOPT_URL, $parUrl . "?" . implode("&", $varGet));
        }
        //配置-POST
        curl_setopt($varCurlObject, CURLOPT_POST, $parPost != [] ? true : false);
        if ($parPost != []) {
            if ($parHeader != [] and isset($parHeader["Content-Type"])) {
                switch ($parHeader["Content-Type"]) {
                    case "application/x-www-form-urlencoded":
                        $parPost = http_build_query($parPost);
                        break;
                    case "application/json":
                        $parPost = json_encode($parPost, JSON_UNESCAPED_UNICODE);
                        break;
                }
            }
            curl_setopt($varCurlObject, CURLOPT_POSTFIELDS, $parPost);
        }
        //配置-Header
        if ($parHeader != []) {
            foreach ($parHeader as $forKey => $forValue) {
                $varHeader[] = "$forKey: $forValue";
            }
            curl_setopt($varCurlObject, CURLOPT_HTTPHEADER, $varHeader);
        }
        //配置-Cookie
        if ($parCookie != []) {
            foreach ($parCookie as $forKey => $forValue) {
                $varCookie[] = "$forKey=$forValue";
            }
            curl_setopt($varCurlObject, CURLOPT_COOKIE, implode(";", $varCookie));
        }
        //请求
        $tempCurlRes = curl_exec($varCurlObject);
        //组装-error
        $varRes["error"] = curl_error($varCurlObject);
        //组装-code
        $varRes["code"] = curl_getinfo($varCurlObject, CURLINFO_HTTP_CODE);
        //组装-header
        $tempHeaderSize = curl_getinfo($varCurlObject, CURLINFO_HEADER_SIZE);
        $varRes["header"]  = trim(substr($tempCurlRes, 0, $tempHeaderSize));
        //组装-body
        $tempBody = substr($tempCurlRes, $tempHeaderSize);
        if (AuthenticationClient::_isJson($tempBody)) $tempBody = json_decode($tempBody, true);
        $varRes["body"] = $tempBody;
        //组装-cookie
        preg_match_all("/set\-cookie:([^\r\n]*)/i", $varRes["header"], $tempCookie);
        $tempCookie = implode(";", $tempCookie[1]);
        $varRes["cookie"] = !empty($tempCookie) ? trim($tempCookie) : "";
        //返回
        curl_close($varCurlObject);
        return $varRes;
    }

    /**
     * 构造HTTP
     */
    private function _requests($parMethod, $parGet = [], $parPost = [], $parHeader = [])
    {
        //处理
        if ($parGet != []) $parGet = $this->_formatData($parGet);
        if ($parPost != []) $parPost = $this->_formatData($parPost);
        //头部
        $varHeader = array(
            "Content-Type" => "application/x-www-form-urlencoded",
            "x-authing-request-from" => "SDK",
            "x-authing-sdk-version" => "php:" . phpversion(),
        );
        $varHeader = array_merge($varHeader, $parHeader);
        //请求
        $varReq = AuthenticationClient::_request($this->_url . $parMethod, $parGet, $parPost, $varHeader);
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
        $matchRes = preg_match("/^(((?:http)|(?:https)):\/\/)?((?:[\w-_]+)(?:\.[\w-_]+)+)(:\d{1,6})?(?:\/.*)?$/", $domain);
        if ($matchRes && $matchRes[3]) {
            $tempA = !empty($matchRes[1]) ? $matchRes[1] : "https://";
            $tempB = $matchRes[4] ? "" : $matchRes[4];
            return $tempA . $matchRes[3] . $tempB;
        }
        throw new \Exception(`无效的域名配置: ` . $domain);
    }

    /**
     * 解析 JWKS
     */
    private static function _parseJWKS($jwks)
    {
        foreach ($jwks["keys"] as $forValue) {
            $res[] = array(
                "id" => $forValue["kid"],
                "key" => \JWT::parseToken($forValue),
            );
        }
        return $res;
    }

    /**
     * 拼接处理 query 参数
     */
    private static function _createQueryParams($params)
    {
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
            $result += substr($characters, floor(rand() * $charactersLength), 1);
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
        $res = $this->buildAuthUrl(array(
            "scope" => !empty($scope) ? $scope : null,
            "state" => !empty($state) ? $state : null,
            "nonce" => !empty($nonce) ? $nonce : null,
            "redirectUri" => !empty($redirectUri) ? $redirectUri : null,
            "forced" => !empty($forced) ? $forced : null,
        ));

        header("Set-Cookie:" . $this->_options["cookieKey"] . "=" . \JWT::base64UrlEncode(json_encode(array(
            "state" => $res["state"],
            "nonce" => $res["nonce"],
            "redirectUri" => empty($redirectUri) ? $this->options["redirectUri"] : $redirectUri,
        ))) . "; HttpOnly; SameSite=Lax");
        header("Location:" . $res["url"]);
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
        $state = empty($state) ? $this->_generateRandomString(16) : $state;
        $nonce = empty($nonce) ? $this->_generateRandomString(16) : $nonce;
        $scope = empty($scope) ? $this->_option["scope"] : $scope;

        $params = array(
            "redirect_uri" => empty($redirectUri) ? $this->_option["redirectUri"] : $redirectUri,
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
     * @param object $req http 请求对象，用于获取认证结果和上下文 Cookie
     * @param object $res http 响应对象，只用于清除上下文 Cookie
     */
    public function handleRedirectCallback($req, $res)
    {
        $url = "http://dummy" . $req["url"];
        $error = $this->_getUrlParam($url, "error");
        if ($error) {
            throw new \Exception("认证服务器返回错误 " . $error . ":" . $this->_getUrlParam($url, "error_description"));
        }

        $code = $this->_getUrlParam($url, "code");
        if (!$code) {
            throw new \Exception("认证服务器未返回授权码");
        }

        $cookieKey = $this->_option["cookieKey"] . "=";
        $txStr = isset($req["headers"]["cookie"]) ? $req["headers"]["cookie"] : $req["headers"]["Cookie"];
        $txStr = explode("; ", $txStr);
        foreach ($txStr as $forValue) {
            if (substr($forValue, 0, strlen($cookieKey)) === $cookieKey) {
                $txStr = substr($forValue, 0, strlen($cookieKey));
            }
        }

        if (!$txStr) {
            throw new \Exception("Cookie 中没有中间态，认证失败");
        }

        $tx = json_decode((\JWT::base64UrlDecode($txStr)), true);
        header("Set-Cookie:" . $this->_option["cookieKey"] . "=;  HttpOnly; SameSite=Lax; Max-Age=0");

        $state = $this->_getUrlParam($url, "state");
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
        $res = \JWT::verifyToken($token);
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
        $res = \JWT::verifyToken($token);
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
            "idToken" => !empty($idToken) ? $idToken : null,
            "redirectUri" => !empty($redirectUri) ? $redirectUri : null,
            "state" => !empty($state) ? $state : null,
        );
        $option = $this->_formatData($option);
        header("Location:" . $this->buildLogoutUrl($option), true, 302);
    }

    /**
     * 生成登出 URL
     * @param string $idToken 可选，用户登录时获取的 ID Token，用于无效化用户 Token，建议传入
     * @param string $redirectUri 可选，登出完成后的重定向目标 URL，覆盖初始化参数中的对应设置
     * @param string $state 可选，传递到目标 URL 的中间状态标识符
     */
    public function buildLogoutUrl($idToken = null, $redirectUri = null, $state = null)
    {
        $redirectUri = empty($redirectUri) ? $this->_option["logoutRedirectUri"] : $redirectUri;
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
        $params = $this->_formatData($params);
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
