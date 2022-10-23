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
    private $_appHost;
    // 用户的 access_token
    private $_accessToken;

    /**
     * 构造函数
     * @param array $option 必须，用于传递参数，如 array("appId" => "AUTHING_APP_ID", "appSecret" => "AUTHING_APP_SECRET", "appHost" => "https://example.authing.cn")
     * @param string appId 必须，应用 ID
     * @param string appSecret 必须，应用 Secret
     * @param string appHost 必须，应用域名，例如 example.authing.cn
     * @param string redirectUri 认证完成后的重定向目标 URL。可选，默认使用控制台中配置的第一个回调地址。
     * @param string logoutRedirectUri 可选，登出完成后的重定向目标 URL
     * @param string scope 可选，应用侧向 Authing 请求的权限，以空格分隔，默认为 "openid profile"，成功获取的权限会出现在 Access Token 的 scope 字段中，例如 openid（OIDC 标准规定的权限，必须包含）、profile（获取用户的基本身份信息）、offline_access（获取用户的 Refresh Token，可用于调用 refreshLoginState 刷新用户的登录态）
     * @param string protocol 可选，协议类型，可选值为 oidc, oauth, saml, cas，默认为 oidc
     * @param string tokenEndPointAuthMethod 可选，获取 token 端点认证方式，默认为 client_secret_post
     * @param string introspectionEndPointAuthMethod 可选，获取 token 端点认证方式，默认为 client_secret_post
     * @param string revocationEndPointAuthMethod 可选，获取 token 端点认证方式，默认为 client_secret_post
     * @param integer timeout 可选，超时时间，单位为秒，默认为 10000（10 秒）
     * @throws \Exception
     */
    public function __construct($option)
    {

        if (
            !isset($option["appId"])
        ) {
            throw new \Exception('请在初始化 AuthenticationClient 时传入 appId');
        }

        if (
            !isset($option["appSecret"])
        ) {
            throw new \Exception('请在初始化 AuthenticationClient 时传入 appSecret');
        }

        if (
            !isset($option["appHost"])
        ) {
            throw new \Exception('请在初始化 AuthenticationClient 时传入 appHost');
        }

        if (!isset($option["scope"])) {
            $option["scope"] = "openid profile";
        }
        if (!isset($option["protocol"])) {
            $option["protocol"] = "oidc";
        }
        if (!isset($option["tokenEndPointAuthMethod"])) {
            $option["tokenEndPointAuthMethod"] = "client_secret_post";
        }
        if (!isset($option["introspectionEndPointAuthMethod"])) {
            $option["introspectionEndPointAuthMethod"] = "client_secret_post";
        }
        if (!isset($option["revocationEndPointAuthMethod"])) {
            $option["revocationEndPointAuthMethod"] = "client_secret_post";
        }
        if (!isset($option["timeout"])) {
            $option["timeout"] = 10;
        }

        if (strpos($option["scope"], "openid") === false) {
            throw new \Exception("scope 中必须包含 openid");
        }

        $this->_option = $option;
        $this->_appHost = $option["appHost"];
    }

    /**
     * 构造协议相关请求
     */
    private function protocolRequest($parMethod, $parPath, $parGet = [], $parPost = [], $parHeader = [])
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
        $res = Util\Tool::request($parMethod, $this->_appHost . $parPath, $parGet, $parPost, $varHeader, $this->_option["timeout"]);
        return $res["body"];
    }

    /**
     * 构造 V3 API 相关请求
     */
    private function request($parMethod, $parPath, $parGet = [], $parPost = [], $parHeader = [])
    {
        //处理
        if ($parGet != []) $parGet = Util\Tool::formatData($parGet);
        if ($parPost != []) $parPost = Util\Tool::formatData($parPost);
        //头部
        $varHeader = array(
            "Content-Type" => "application/json",
            "x-authing-request-from" => "SDK",
            "x-authing-sdk-version" => "php:" . phpversion(),
            "x-authing-app-id" => $this->_option["appId"],
        );

        if ($this->_accessToken != "") {
            $varHeader["authorization"] = $this->_accessToken;
        }

        $varHeader = array_merge($varHeader, $parHeader);
        //请求
        $varRes = Util\Tool::request($parMethod, $this->_appHost . $parPath, $parGet, $parPost, $varHeader, $this->_option["timeout"]);
        //返回
        return $varRes;
    }

    /**
     * 拼接请求参数
     */
    private static function _createQueryParams($params)
    {
        if (empty($params)) return "";
        foreach ($params as $forKey => $forValue) {
            if (is_array($forValue)) {
                foreach ($forValue as $forValues) {
                    $forValues = urlencode($forValues);
                    $varParams[] = "$forKey=$forValues";
                }
            } else {
                $forValue = urlencode($forValue);
                $varParams[] = "$forKey=$forValue";
            }
        }
        return implode("&", $varParams);
    }

    public function setAccessToken($accessToken)
    {
        $this->_accessToken = $accessToken;
    }

    /**
     * @throws \Exception
     */
    private function _getAccessTokenByCodeWithClientSecretPost($code, $codeVerifier = null)
    {
        $data = array(
            'client_id' => $this->_option["appId"],
            'client_secret' => $this->_option["appSecret"],
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->_option["redirectUri"],
            'code_verifier' => $codeVerifier
        );
        $api = '';
        if ($this->_option["protocol"] === 'oidc') {
            $api = '/oidc/token';
        } elseif ($this->_option["protocol"] === 'oauth') {
            $api = '/oauth/token';
        }
        return $this->protocolRequest("POST", $api, null, $data, []);
    }

    private function _generateBasicAuthToken()
    {
        return 'Basic ' . base64_encode($this->_option["appId"] . ":" . $this->_option["appSecret"]);
    }


    /**
     * @throws \Exception
     */
    private function _getAccessTokenByCodeWithClientSecretBasic($code, $codeVerifier = null)
    {
        $api = '';
        if ($this->_option["protocol"] === 'oidc') {
            $api = '/oidc/token';
        } elseif ($this->_option["protocol"] === 'oauth') {
            $api = '/oauth/token';
        }
        $data = array(
            'client_id' => $this->_option["appId"],
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->_option["redirectUri"],
            'code_verifier' => $codeVerifier
        );
        return $this->protocolRequest("POST", $api, null, $data, [
            "Authorization" => $this->_generateBasicAuthToken(),
        ]);
    }

    /**
     * @throws \Exception
     */
    public function _getAccessTokenByCodeWithNone($code, $codeVerifier = null)
    {
        $api = '';
        if ($this->_option["protocol"] === 'oidc') {
            $api = '/oidc/token';
        } elseif ($this->_option["protocol"] === 'oauth') {
            $api = '/oauth/token';
        }
        $data = array(
            "client_id" => $this->_option["appId"],
            "grant_type" =>
                'authorization_code',
            "code" => $code,
            "redirect_uri" => $this->_option["redirectUri"],
            'code_verifier' => $codeVerifier
        );
        return $this->protocolRequest("POST", $api, null, $data, []);
    }

    /**
     * @throws \Exception
     */
    public function getAccessTokenByCode($code, $codeVerifier = null)
    {
        if (
            !isset($this->_option["redirectUri"])
        ) {
            throw new \Exception('请在初始化 AuthenticationClient 时传入 redirectUri');
        }

        if (isset($this->_option["tokenEndPointAuthMethod"]) && $this->_option["tokenEndPointAuthMethod"] === 'client_secret_post') {
            return $this->_getAccessTokenByCodeWithClientSecretPost($code, $codeVerifier);
        }
        if (isset($this->_option["tokenEndPointAuthMethod"]) && $this->_option["tokenEndPointAuthMethod"] === 'client_secret_basic') {
            return $this->_getAccessTokenByCodeWithClientSecretBasic($code, $codeVerifier);
        }
        if (isset($this->_option["tokenEndPointAuthMethod"]) && $this->_option["tokenEndPointAuthMethod"] === 'none') {
            return $this->_getAccessTokenByCodeWithNone($code, $codeVerifier);
        }
    }

    /**
     * @param array $options options.codeChallenge 为一个长度大于等于 43 的字符串，options.method 可选值为 S256、plain，默认为 S256。
     * @throws \Exception
     */
    public function getCodeChallengeDigest(array $options)
    {
        if (empty($options)) {
            throw new \Exception(
                '请提供 options 参数，options.codeChallenge 为一个长度大于等于 43 的字符串，options.method 可选值为 S256、plain，默认为 S256。'
            );
        }
        if (empty($options['codeChallenge'])) {
            throw new \Exception(
                '请提供 options.codeChallenge，值为一个长度大于等于 43 的字符串'
            );
        }
        if (!isset($options["method"])) {
            $options['method'] = "S256";
        }
        $method = $options['method'];
        if ($method == 'S256') {
            $str = base64_encode(hash("sha256", $options['codeChallenge']));
            str_replace('+', '-', $str);
            str_replace('/', '_', $str);
            str_replace('=', '', $str);
            return $str;
        } else if ($method == 'plain') {
            return $options['codeChallenge'];
        } else {
            throw new \Exception('不支持的 options.method，可选值为 S256、plain');
        }
    }

    /**
     * @param string $accessKeyId 编程访问账号 AccessKey，如果不传默认使用初始化 SDK 时传入的 appId。
     * @param string $accessKeySecret 编程访问账号 SecretKey，如果不传默认使用初始化 SDK 时传入的 appSecret。
     * @param string $scope 权限项目，空格分隔的字符串，每一项代表一个权限。详情请见机器间（M2M）授权：https://docs.authing.cn/v2/guides/authorization/m2m-authz.html
     * @return mixed
     * @throws \Exception
     */
    public function getAccessTokenByClientCredentials($scope, $accessKeyId = null, $accessKeySecret = null)
    {
        if (!isset($scope)) {
            throw new \Exception(
                '请传入 scope 参数，请看文档：https://docs.authing.cn/v2/guides/authorization/m2m-authz.html'
            );
        }
        $accessKeyId
            ? $accessKey = $accessKeyId : $accessKey = $this->_option["appId"];
        $accessKeySecret
            ? $accessSecret = $accessKeySecret : $accessSecret = $this->_option["appSecret"];
        $data = array(
            "client_id" => $accessKey,
            "client_secret" => $accessSecret,
            "grant_type" => 'client_credentials',
            "scope" => $scope,
        );
        $api = '';
        if ($this->_option["protocol"] === 'oidc') {
            $api = '/oidc/token';
        } elseif ($this->_option["protocol"] === 'oauth') {
            $api = '/oauth/token';
        }
        return $this->protocolRequest("POST", $api, null, $data, []);
    }

    public function _buildOidcAuthorizeUrl(array $options)
    {
        $map = [
            'appId' => 'client_id',
            'scope' => 'scope',
            'state' => 'state',
            'nonce' => 'nonce',
            'responseMode' => 'response_mode',
            'responseType' => 'response_type',
            'redirectUri' => 'redirect_uri',
            'codeChallenge' => 'code_challenge',
            'codeChallengeMethod' => 'code_challenge_method'
        ];
        $res = [
            'nonce' => Util\Tool::randomString(),
            'state' => Util\Tool::randomString(),
            'scope' => 'openid profile email phone address',
            'client_id' => $this->_option["appId"],
            'response_mode' => 'query',
            'redirect_uri' => $this->_option["redirectUri"],
            'response_type' => 'code',
        ];
        foreach ($map as $key => $value) {
            if (isset($options) && isset($options[$key]) && $options[$key]) {
                if ($key === 'scope' && strpos($options['scope'], 'offline_access')) {
                    $res['prompt'] = 'consent';
                }
                $res[$value] = $options[$key];
            }
        }
        $params = http_build_query($res);
        $authorizeUrl = $this->_appHost . '/oidc/auth?' . $params;
        return $authorizeUrl;
    }

    public function _buildOauthAuthorizeUrl(array $options)
    {
        $map = [
            'appId' => 'client_id',
            'scope' => 'scope',
            'state' => 'state',
            'responseType' => 'response_type',
            'redirectUri' => 'redirect_uri'
        ];
        $res = [
            'state' => Util\Tool::randomString(),
            'scope' => 'user',
            'client_id' => $this->_option["appId"],
            'redirect_uri' => $this->_option["redirectUri"],
            'response_type' => 'code'
        ];
        foreach ($map as $key => $value) {
            if (isset($options) && isset($options[$key]) && $options[$key]) {
                $res[$value] = $options[$key];
            }
        }
        $params = http_build_query($res);
        $authorizeUrl = $this->_appHost . '/oauth/auth?' . $params;
        return $authorizeUrl;
    }

    public function _buildSamlAuthorizeUrl()
    {
        return $this->_appHost . '/saml-idp/' . $this->_option["appId"];
    }

    public function _buildCasAuthorizeUrl(array $options)
    {
        if (isset($options['service'])) {
            return $this->_appHost . '/cas-idp/' . $this->_option["appId"] . '?service=' . $options['service'];
        }
        return $this->_appHost . '/cas-idp' . $this->_option["appId"];
    }

    /**
     * @throws \Exception
     */
    public function buildAuthorizeUrl($options = [])
    {
        if (!isset($this->_option["appHost"])) {
            throw new \Exception(
                '请在初始化 AuthenticationClient 时传入应用域名 appHost 参数，形如：https://app1.authing.cn'
            );
        }
        if ($this->_option["protocol"] === 'oidc') {
            return $this->_buildOidcAuthorizeUrl($options);
        }
        if ($this->_option["protocol"] === 'oauth') {
            return $this->_buildOauthAuthorizeUrl($options);
        }
        if ($this->_option["protocol"] === 'saml') {
            return $this->_buildSamlAuthorizeUrl();
        }
        if ($this->_option["protocol"] === 'cas') {
            return $this->_buildCasAuthorizeUrl($options);
        }
        throw new \Exception(
            '不支持的协议类型，请在初始化 AuthenticationClient 时传入 protocol 参数，可选值为 oidc、oauth、saml、cas'
        );
    }

    public function _buildOidcLogoutUrl($idToken = null, $redirectUri = null, $state = null)
    {
        $postLogoutRedirectUri = "";
        if (isset($redirectUri)) {
            $postLogoutRedirectUri = $redirectUri;
        } else if (isset($this->_option["logoutRedirectUri"])) {
            $postLogoutRedirectUri = $this->_option["logoutRedirectUri"];
        }
        if ($postLogoutRedirectUri) {
            if (!isset($idToken)) {
                throw new \Exception(
                    '必须同时传入 idToken 和 redirectUri 参数，或者同时都不传入'
                );
            }
            $params = array(
                "post_logout_redirect_uri" => $postLogoutRedirectUri,
                "id_token_hint" => $idToken,
                "state" => $state,
            );
        } else {
            $params = array(
                "state" => $state,
            );
        }
        $params = Util\Tool::formatData($params);
        return $this->_appHost . "/oidc/session/end?" . $this->_createQueryParams($params);
    }

    public function _buildCasLogoutUrl($redirectUri = null)
    {
        if (isset($redirectUri)) {
            return $this->_appHost . '/cas-idp/logout?url=' . $redirectUri;
        }
        return $this->_appHost . '/cas-idp/logout';
    }

    public function _buildEasyLogoutUrl($redirectUri = null)
    {
        if ($redirectUri) {
            return $this->_appHost . '/login/profile/logout?redirect_uri=' . $redirectUri;
        }
        return $this->_appHost . '/login/profile/logout';
    }

    /**
     * 生成登出 URL
     * @param string $idToken 可选，用户登录时获取的 ID Token，用于无效化用户 Token，建议传入
     * @param string $redirectUri 可选，登出完成后的重定向目标 URL，覆盖初始化参数中的对应设置
     * @param string $state 可选，传递到目标 URL 的中间状态标识符
     */
    public function buildLogoutUrl($options = [])
    {
        $redirectUri = isset($options["logoutRedirectUri"]) ? $options["logoutRedirectUri"] : null;
        $idToken = isset($options["idToken"]) ? $options["idToken"] : null;
        $state = isset($options["state"]) ? $options["state"] : null;
        if ($this->_option["protocol"] === 'cas') {
            return $this->_buildCasLogoutUrl($redirectUri);
        }
        if ($this->_option["protocol"] === 'oidc') {
            return $this->_buildOidcLogoutUrl($idToken, $redirectUri, $state);
        }
        return $this->_buildEasyLogoutUrl($redirectUri);
    }

    /**
     * @param $accessToken 使用 getAccessTokenByCode 接口获取到的 access_token
     * @return mixed
     */
    public function getUserInfoByAccessToken($accessToken)
    {
        $api = '';
        if ($this->_option["protocol"] === 'oidc') {
            $api = '/oidc/me';
        } elseif ($this->_option["protocol"] === 'oauth') {
            $api = '/oauth/me';
        }
        return $this->protocolRequest("POST", $api, null, null, [
            'Authorization' => 'Bearer ' . $accessToken,
        ]);
    }

    public function _getNewAccessTokenByRefreshTokenWithClientSecretPost($refreshToken)
    {
        $api = '';
        if ($this->_option["protocol"] === 'oidc') {
            $api = '/oidc/token';
        } elseif ($this->_option["protocol"] === 'oauth') {
            $api = '/oauth/token';
        }
        $data = array(
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
        );
        return $this->protocolRequest("POST", $api, null, $data, []);
    }

    function _getNewAccessTokenByRefreshTokenWithClientSecretBasic($refreshToken)
    {
        $api = '';
        if ($this->_option["protocol"] === 'oidc') {
            $api = '/oidc/token';
        } elseif ($this->_option["protocol"] === 'oauth') {
            $api = '/oauth/token';
        }
        $data = array(
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
        );
        return $this->protocolRequest("POST", $api, null, $data, [
            'Authorization' => $this->_generateBasicAuthToken(),
        ]);
    }

    function _getNewAccessTokenByRefreshTokenWithNone($refreshToken)
    {
        $api = '';
        if ($this->_option["protocol"] === 'oidc') {
            $api = '/oidc/token';
        } elseif ($this->_option["protocol"] === 'oauth') {
            $api = '/oauth/token';
        }
        $data = array(
            'client_id' => $this->_option["appId"],
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
        );
        return $this->protocolRequest("POST", $api, null, $data, []);
    }

    public function getNewAccessTokenByRefreshToken($refreshToken)
    {
        if (!in_array($this->_option["protocol"], ['oauth', 'oidc'])) {
            throw new \Exception(
                '初始化 AuthenticationClient 时传入的 protocol 参数必须为 oauth 或 oidc，请检查参数'
            );
        }
        if (!isset($this->_option["appSecret"]) && $this->_option["introspectionEndPointAuthMethod"] !== 'none') {
            throw new \Exception(
                '请在初始化 AuthenticationClient 时传入 appId 和 appSecret 参数'
            );
        }
        if ($this->_option["tokenEndPointAuthMethod"] === 'client_secret_post') {
            $res = $this->_getNewAccessTokenByRefreshTokenWithClientSecretPost($refreshToken);
            return $res;
        }
        if ($this->_option["tokenEndPointAuthMethod"] === 'none') {
            $res = $this->_getNewAccessTokenByRefreshTokenWithNone($refreshToken);
            return $res;
        }
        if ($this->_option["tokenEndPointAuthMethod"] === 'client_secret_basic') {
            $res = $this->_getNewAccessTokenByRefreshTokenWithClientSecretBasic($refreshToken);
            return $res;
        }
    }

    public function _introspectTokenWithClientSecretPost($token)
    {
        $qstr = array(
            'client_id' => $this->_option["appId"],
            'client_secret' => $this->_option["appSecret"],
            'token' => $token,
        );
        $api = '';
        if ($this->_option["protocol"] === 'oidc') {
            $api = '/oidc/token/introspection';
        } elseif ($this->_option["protocol"] === 'oauth') {
            $api = '/oauth/token/introspection';
        }
        return $this->protocolRequest("POST", $api, null, $qstr, []);
    }

    public function _introspectTokenWithClientSecretBasic($token)
    {
        $qstr = array(
            'token' => $token,
        );
        $api = '';
        if ($this->_option["protocol"] === 'oidc') {
            $api = '/oidc/token/introspection';
        } elseif ($this->_option["protocol"] === 'oauth') {
            $api = '/oauth/token/introspection';
        }
        return $this->protocolRequest("POST", $api, null, $qstr, [
            'Authorization' => $this->_generateBasicAuthToken(),
        ]);
    }

    public function _introspectTokenWithNone(string $token)
    {
        $qstr = array(
            'client_id' => $this->_option["appId"],
            'token' => $token,
        );
        $api = '';
        if ($this->_option["protocol"] === 'oidc') {
            $api = '/oidc/token/introspection';
        } elseif ($this->_option["protocol"] === 'oauth') {
            $api = '/oauth/token/introspection';
        }
        return $this->protocolRequest("POST", $api, null, $qstr, []);
    }

    /**
     * @throws \Exception
     */
    public function introspectToken($token)
    {
        if (!in_array($this->_option["protocol"], ['oauth', 'oidc'])) {
            throw new \Exception(
                '初始化 AuthenticationClient 时传入的 protocol 参数必须为 oauth 或 oidc，请检查参数'
            );
        }
        if (!isset($this->_option["appSecret"]) && $this->_option["introspectionEndPointAuthMethod"] !== 'none') {
            throw new \Exception(
                '请在初始化 AuthenticationClient 时传入 appId 和 secret 参数'
            );
        }
        if ($this->_option["introspectionEndPointAuthMethod"] === 'client_secret_post') {
            $res = $this->_introspectTokenWithClientSecretPost($token);
            return $res;
        }
        if ($this->_option["introspectionEndPointAuthMethod"] === 'none') {
            $res = $this->_introspectTokenWithNone($token);
            return $res;
        }
        if ($this->_option["introspectionEndPointAuthMethod"] === 'client_secret_basic') {
            $res = $this->_introspectTokenWithClientSecretBasic($token);
            return $res;
        }
        throw new \Exception(
            '初始化 AuthenticationClient 时传入的 introspectionEndPointAuthMethod 参数可选值为 client_secret_base、client_secret_post、none，请检查参数'
        );
    }

    /**
     * @throws \Exception
     */
    public function revokeToken($token)
    {
        if (!in_array($this->_option["protocol"], ['oauth', 'oidc'])) {
            throw new \Exception('初始化 AuthenticationClient 时传入的 protocol 参数必须为 oauth 或 oidc，请检查参数');
        }
        if (!isset($this->_option["appSecret"]) && $this->_option["revocationEndPointAuthMethod"] !== 'none') {
            throw new \Exception(
                '请在初始化 AuthenticationClient 时传入 appId 和 secret 参数'
            );
        }
        if ($this->_option["revocationEndPointAuthMethod"] === 'client_secret_post') {
            $this->_revokeTokenWithClientSecretPost($token);
            return true;
        }
        if ($this->_option["revocationEndPointAuthMethod"] === 'none') {
            $this->_revokeTokenWithClientSecretBasic($token);
            return true;
        }
        if ($this->_option["revocationEndPointAuthMethod"] === 'client_secret_basic') {
            $this->_revokeTokenWithNone($token);
            return true;
        }
    }

    public function _revokeTokenWithClientSecretPost($token)
    {
        $qstr = array(
            'client_id' => $this->_option["appId"],
            'client_secret' => $this->_option["appSecret"],
            'token' => $token,
        );
        $api = '';
        if ($this->_option["protocol"] === 'oidc') {
            $api = '/oidc/token/revocation';
        } elseif ($this->_option["protocol"] === 'oauth') {
            $api = '/oauth/token/revocation';
        }
        return $this->protocolRequest("POST", $api, null, $qstr, []);
    }

    public function _revokeTokenWithClientSecretBasic($token)
    {
        $qstr = array(
            'client_id' => $this->_option["appId"],
            'token' => $token,
        );
        $api = '';
        if ($this->_option["protocol"] === 'oidc') {
            $api = '/oidc/token/revocation';
        } elseif ($this->_option["protocol"] === 'oauth') {
            $api = '/oauth/token/revocation';
        }
        return $this->protocolRequest("POST", $api, null, $qstr, []);
    }

    public function _revokeTokenWithNone($token)
    {
        $qstr = array(
            'token' => $token,
        );
        $api = '';
        if ($this->_option["protocol"] === 'oidc') {
            $api = '/oidc/token/revocation';
        } elseif ($this->_option["protocol"] === 'oauth') {
            throw new \Exception(
                'OAuth 2.0 暂不支持用 client_secret_basic 模式身份验证撤回 Token'
            );
        }
        return $this->protocolRequest("POST", $api, null, $qstr, [
            'Authorization' => $this->_generateBasicAuthToken(),
        ]);
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
     * 在应用回调端点处理认证返回结果，利用 Cookie 中传递的上下文信息进行安全验证，并获取用户登录态
     * @param string $url url
     * @param string $cookie cookie
     */
    public function handleRedirectCallback($url, $cookie)
    {
        $error = Util\Tool::getUrlParam($url, "error");
        if ($error) {
            throw new \Exception("认证服务器返回错误 " . $error . " :" . Util\Tool::getUrlParam($url, "error_description"));
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
     * 将浏览器重定向到 Authing 的登出发起 URL 进行登出
     * @param string $idToken 可选，用户登录时获取的 ID Token，用于无效化用户 Token，建议传入
     * @param string $redirectUri 可选，登出完成后的重定向目标 URL，覆盖初始化参数中的对应设置
     * @param string $state 可选，传递到目标 URL 的中间状态标识符
     */
    public function logoutWithRedirect($idToken = null, $redirectUri = null, $state = null)
    {
        $res = $this->buildLogoutUrl(
            Util\Tool::getNotEmpty($idToken),
            Util\Tool::getNotEmpty($redirectUri),
            Util\Tool::getNotEmpty($state)
        );

        header("Location:" . $res);

        return $res;
    }


    /**
     * 使用邮箱 + 密码登录
     * @summary 使用邮箱 + 密码登录
     *
     * @param string $email 邮箱
     * @param string $password 用户密码，默认不加密。Authing 所有 API 均通过 HTTPS 协议对密码进行安全传输，可以在一定程度上保证安全性。如果你还需要更高级别的安全性，我们还支持 `RSA256` 和国密 `SM2` 的密码加密方式。详情见可选参数 `options.passwordEncryptType`。。
     * @param object $option 认证可选参数，详情请见文档
     * @return LoginTokenRespDto 成功认证
     */
    public function signInByEmailPassword($email, $password, $option = null)
    {
        // 组装请求
        $varPost = array(
            "connection" => "PASSWORD",
            "passwordPayload" => (object)[
                "email" => $email,
                "password" => $password
            ],
            "options" => $option,
            "client_id" => $this->_option["appId"],
            "client_secret" => $this->_option["appSecret"],
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/signin", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 使用用户名 + 密码登录
     * @summary 使用用户名 + 密码登录
     *
     * @param string $username 用户名
     * @param string $password 用户密码，默认不加密。Authing 所有 API 均通过 HTTPS 协议对密码进行安全传输，可以在一定程度上保证安全性。如果你还需要更高级别的安全性，我们还支持 `RSA256` 和国密 `SM2` 的密码加密方式。详情见可选参数 `options.passwordEncryptType`。。
     * @param object $option 认证可选参数，详情请见文档
     * @return LoginTokenRespDto 成功认证
     */
    public function signInByUsernamePassword($username, $password, $option = null)
    {
        // 组装请求
        $varPost = array(
            "connection" => "PASSWORD",
            "passwordPayload" => (object)[
                "username" => $username,
                "password" => $password
            ],
            "options" => $option,
            "client_id" => $this->_option["appId"],
            "client_secret" => $this->_option["appSecret"],
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/signin", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 使用手机号 + 密码登录
     * @summary 使用手机号 + 密码登录
     *
     * @param string $phone 手机号
     * @param string $password 用户密码，默认不加密。Authing 所有 API 均通过 HTTPS 协议对密码进行安全传输，可以在一定程度上保证安全性。如果你还需要更高级别的安全性，我们还支持 `RSA256` 和国密 `SM2` 的密码加密方式。详情见可选参数 `options.passwordEncryptType`。。
     * @param object $option 认证可选参数，详情请见文档
     * @return LoginTokenRespDto 成功认证
     */
    public function signInByPhonePassword($phone, $password, $option = null)
    {
        // 组装请求
        $varPost = array(
            "connection" => "PASSWORD",
            "passwordPayload" => (object)[
                "phone" => $phone,
                "password" => $password
            ],
            "options" => $option,
            "client_id" => $this->_option["appId"],
            "client_secret" => $this->_option["appSecret"],
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/signin", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 使用账号（用户名/手机号/邮箱） + 密码登录
     * @summary 使用账号（用户名/手机号/邮箱） + 密码登录
     *
     * @param string $account 账号（用户名/手机号/邮箱）
     * @param string $password 用户密码，默认不加密。Authing 所有 API 均通过 HTTPS 协议对密码进行安全传输，可以在一定程度上保证安全性。如果你还需要更高级别的安全性，我们还支持 `RSA256` 和国密 `SM2` 的密码加密方式。详情见可选参数 `options.passwordEncryptType`。。
     * @param object $option 认证可选参数，详情请见文档
     * @return LoginTokenRespDto 成功认证
     */
    public function signInByAccountPassword($account, $password, $option = null)
    {
        // 组装请求
        $varPost = array(
            "connection" => "PASSWORD",
            "passwordPayload" => (object)[
                "account" => $account,
                "password" => $password
            ],
            "options" => $option,
            "client_id" => $this->_option["appId"],
            "client_secret" => $this->_option["appSecret"],
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/signin", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 使用邮箱 + 验证码登录
     * @summary 使用邮箱 + 验证码登录
     *
     * @param string $email 邮箱
     * @param string $passCode 密码
     * @param object $option 认证可选参数，详情请见文档
     * @return LoginTokenRespDto 成功认证
     */
    public function signInByEmailPassCode($email, $passCode, $option = null)
    {
        // 组装请求
        $varPost = array(
            "connection" => "PASSCODE",
            "passwordPayload" => (object)[
                "email" => $email,
                "passCode" => $passCode,
            ],
            "options" => $option,
            "client_id" => $this->_option["appId"],
            "client_secret" => $this->_option["appSecret"],
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/signin", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 使用手机号 + 验证码登录
     * @summary 使用手机号 + 验证码登录
     *
     * @param string $phone 手机号
     * @param string $passCode 密码
     * @param string $phoneCountryCode 手机区号
     * @param object $option 认证可选参数，详情请见文档
     * @return LoginTokenRespDto 成功认证
     */
    public function signInByPhonePassCode($phone, $passCode, $phoneCountryCode = null, $option = null)
    {
        // 组装请求
        $varPost = array(
            "connection" => "PASSCODE",
            "passCodePayload" => (object)[
                "phone" => $phone,
                "phoneCountryCode" => $phoneCountryCode,
                "passCode" => $passCode,
            ],
            "options" => $option,
            "client_id" => $this->_option["appId"],
            "client_secret" => $this->_option["appSecret"],
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/signin", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 使用 LDAP 用户目录的账号密码登录
     * @summary 使用 LDAP 用户目录的账号密码登录
     *
     * @param string $sAMAccountName LDAP AD 用户目录中账号的 sAMAccountName
     * @param string $password 用户密码，默认不加密。Authing 所有 API 均通过 HTTPS 协议对密码进行安全传输，可以在一定程度上保证安全性。如果你还需要更高级别的安全性，我们还支持 `RSA256` 和国密 `SM2` 的密码加密方式。详情见可选参数 `options.passwordEncryptType`。。
     * @param object $option 认证可选参数，详情请见文档
     * @return LoginTokenRespDto 成功认证
     */
    public function signInByLdap($sAMAccountName, $password, $option = null)
    {
        // 组装请求
        $varPost = array(
            "connection" => "LDAP",
            "ldapPayload" => (object)[
                "sAMAccountName" => $sAMAccountName,
                "password" => $password,
            ],
            "options" => $option,
            "client_id" => $this->_option["appId"],
            "client_secret" => $this->_option["appSecret"],
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/signin", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 使用 Windows AD 用户目录的账号密码登录
     * @summary 使用 Windows AD 用户目录的账号密码登录
     *
     * @param string $sAMAccountName Windows AD 用户目录中账号的 sAMAccountName
     * @param string $password 用户密码，默认不加密。Authing 所有 API 均通过 HTTPS 协议对密码进行安全传输，可以在一定程度上保证安全性。如果你还需要更高级别的安全性，我们还支持 `RSA256` 和国密 `SM2` 的密码加密方式。详情见可选参数 `options.passwordEncryptType`。。
     * @param object $option 认证可选参数，详情请见文档
     * @return LoginTokenRespDto 成功认证
     */
    public function signInByAd($sAMAccountName, $password, $option = null)
    {
        // 组装请求
        $varPost = array(
            "connection" => "LDAP",
            "ldapPayload" => (object)[
                "sAMAccountName" => $sAMAccountName,
                "password" => $password,
            ],
            "options" => $option,
            "client_id" => $this->_option["appId"],
            "client_secret" => $this->_option["appSecret"],
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/signin", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 使用用户名 + 密码注册
     * @summary 使用用户名 + 密码注册
     *
     * @param string $username 用户名
     * @param string $password 用户密码，默认不加密。Authing 所有 API 均通过 HTTPS 协议对密码进行安全传输，可以在一定程度上保证安全性。如果你还需要更高级别的安全性，我们还支持 `RSA256` 和国密 `SM2` 的密码加密方式。详情见可选参数 `options.passwordEncryptType`。
     * @param object $profile 用户信息，可选
     * @param object $option 注册可选参数，详情请见文档
     */
    public function signUpByUsernamePassword($username, $password, $profile = null, $option = null)
    {
        // 组装请求
        $varPost = array(
            "connection" => "PASSWORD",
            "passwordPayload" => (object)[
                "username" => $username,
                "password" => $password,
            ],
            "profile" => $profile,
            "options" => $option,
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/signup", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 使用邮箱 + 密码注册
     * @summary 使用邮箱 + 密码注册
     *
     * @param string $email 邮箱
     * @param string $password 用户密码，默认不加密。Authing 所有 API 均通过 HTTPS 协议对密码进行安全传输，可以在一定程度上保证安全性。如果你还需要更高级别的安全性，我们还支持 `RSA256` 和国密 `SM2` 的密码加密方式。详情见可选参数 `options.passwordEncryptType`。
     * @param object $profile 用户信息，可选
     * @param object $option 注册可选参数，详情请见文档
     */
    public function signUpByEmailPassword($email, $password, $profile = null, $option = null)
    {
        // 组装请求
        $varPost = array(
            "connection" => "PASSWORD",
            "passwordPayload" => (object)[
                "email" => $email,
                "password" => $password,
            ],
            "profile" => $profile,
            "options" => $option,
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/signup", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 使用手机号 + 验证码注册
     * @summary 使用手机号 + 验证码注册
     *
     * @param string $phone 手机号
     * @param string $passCode 验证码
     * @param string $phoneCountryCode 手机区号，可选
     * @param object $profile 用户信息，可选
     * @param object $option 注册可选参数，详情请见文档
     */
    public function signUpByPhonePassCode($phone, $passCode, $phoneCountryCode = null, $profile = null, $option = null)
    {
        // 组装请求
        $varPost = array(
            "connection" => "PASSCODE",
            "passCodePayload" => (object)[
                "phone" => $phone,
                "passCode" => $passCode,
                "phoneCountryCode" => $phoneCountryCode
            ],
            "profile" => $profile,
            "options" => $option,
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/signup", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 使用邮箱 + 验证码注册
     * @summary 使用邮箱 + 验证码注册
     *
     * @param string $email 邮箱
     * @param string $passCode 验证码
     * @param object $profile 用户信息，可选
     * @param object $option 注册可选参数，详情请见文档
     */
    public function signUpByEmailPassCode($email, $passCode, $profile = null, $option = null)
    {
        // 组装请求
        $varPost = array(
            "connection" => "PASSCODE",
            "passCodePayload" => (object)[
                "email" => $email,
                "passCode" => $passCode,
            ],
            "profile" => $profile,
            "options" => $option,
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/signup", null, $varPost);
        // 返回
        return $varRes["body"];
    }


    // ==== AUTO GENERATED AUTHENTICATION METHODS BEGIN ====

    /**
     * 使用用户凭证登录
     * @summary 使用用户凭证登录
     * @description
     * 此端点为基于直接 API 调用形式的登录端点，适用于你需要自建登录页面的场景。**此端点暂时不支持 MFA、信息补全、首次密码重置等流程，如有需要，请使用 OIDC 标准协议认证端点。**
     *
     *
     * 注意事项：取决于你在 Authing 创建应用时选择的**应用类型**和应用配置的**换取 token 身份验证方式**，在调用此接口时需要对客户端的身份进行不同形式的验证。
     *
     * <details>
     * <summary>点击展开详情</summary>
     *
     * <br>
     *
     * 你可以在 [Authing 控制台](https://console.authing.cn) 的**应用** - **自建应用** - **应用详情** - **应用配置** - **其他设置** - **授权配置**
     * 中找到**换取 token 身份验证方式** 配置项：
     *
     * > 单页 Web 应用和客户端应用隐藏，默认为 `none`，不允许修改；后端应用和标准 Web 应用可以修改此配置项。
     *
     * ![](https://files.authing.co/api-explorer/tokenAuthMethod.jpg)
     *
     * #### 换取 token 身份验证方式为 none 时
     *
     * 调用此接口不需要进行额外操作。
     *
     * #### 换取 token 身份验证方式为 client_secret_post 时
     *
     * 调用此接口时必须在 body 中传递 `client_id` 和 `client_secret` 参数，作为验证客户端身份的条件。其中 `client_id` 为应用 ID、`client_secret` 为应用密钥。
     *
     * #### 换取 token 身份验证方式为 client_secret_basic 时
     *
     * 调用此接口时必须在 HTTP 请求头中携带 `authorization` 请求头，作为验证客户端身份的条件。`authorization` 请求头的格式如下（其中 `client_id` 为应用 ID、`client_secret` 为应用密钥。）：
     *
     * ```
     * Basic base64(<client_id>:<client_secret>)
     * ```
     *
     * 结果示例：
     *
     * ```
     * Basic NjA2M2ZiMmYzY3h4eHg2ZGY1NWYzOWViOjJmZTdjODdhODFmODY3eHh4eDAzMjRkZjEyZGFlZGM3
     * ```
     *
     * JS 代码示例：
     *
     * ```js
     * 'Basic ' + Buffer.from(client_id + ':' + client_secret).toString('base64');
     * ```
     *
     * </details>
     *
     *
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'PASSWORD' | 'PASSCODE' | 'LDAP' | 'AD' connection 必须，认证方式：
     * - `PASSWORD`: 使用密码方式进行认证。
     * - `PASSCODE`: 使用一次性临时验证码进行认证。
     * - `LDAP`: 基于 LDAP 用户目录进行认证。
     * - `AD`: 基于 Windows AD 用户目录进行认证。
     *
     * @param SignInByPasswordPayloadDto passwordPayload 可选，当认证方式为 `PASSWORD` 时此参数必填。，默认 null
     * @param SignInByPassCodePayloadDto passCodePayload 可选，当认证方式为 `PASSCODE` 时此参数必填，默认 null
     * @param SignInByAdPayloadDto adPayload 可选，当认证方式为 `AD` 时此参数必填，默认 null
     * @param SignInByLdapPayloadDto ldapPayload 可选，当认证方式为 `LDAP` 时此参数必填，默认 null
     * @param SignInOptionsDto options 可选，可选参数，默认 null
     * @param string client_id 可选，应用 ID。当应用的「换取 token 身份验证方式」配置为 `client_secret_post` 需要传。，默认 null
     * @param string client_secret 可选，应用密钥。当应用的「换取 token 身份验证方式」配置为 `client_secret_post` 需要传。，默认 null
     * @return LoginTokenRespDto 成功认证
     */
    public function signInByCredentials($option = array())
    {
        // 组装请求
        $varPost = array(
            "connection" => Util\Tool::getOrDefault($option, "connection", null),
            "passwordPayload" => Util\Tool::getOrDefault($option, "passwordPayload", null),
            "passCodePayload" => Util\Tool::getOrDefault($option, "passCodePayload", null),
            "adPayload" => Util\Tool::getOrDefault($option, "adPayload", null),
            "ldapPayload" => Util\Tool::getOrDefault($option, "ldapPayload", null),
            "options" => Util\Tool::getOrDefault($option, "options", null),
            "client_id" => Util\Tool::getOrDefault($option, "client_id", null),
            "client_secret" => Util\Tool::getOrDefault($option, "client_secret", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/signin", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 使用移动端社会化登录
     * @summary 使用移动端社会化登录
     * @description
     * 此端点为移动端社会化登录接口，使用第三方移动社会化登录返回的临时凭证登录，并换取用户的 `id_token` 和 `access_token`。请先阅读相应社会化登录的接入流程。
     *
     *
     * 注意事项：取决于你在 Authing 创建应用时选择的**应用类型**和应用配置的**换取 token 身份验证方式**，在调用此接口时需要对客户端的身份进行不同形式的验证。
     *
     * <details>
     * <summary>点击展开详情</summary>
     *
     * <br>
     *
     * 你可以在 [Authing 控制台](https://console.authing.cn) 的**应用** - **自建应用** - **应用详情** - **应用配置** - **其他设置** - **授权配置**
     * 中找到**换取 token 身份验证方式** 配置项：
     *
     * > 单页 Web 应用和客户端应用隐藏，默认为 `none`，不允许修改；后端应用和标准 Web 应用可以修改此配置项。
     *
     * ![](https://files.authing.co/api-explorer/tokenAuthMethod.jpg)
     *
     * #### 换取 token 身份验证方式为 none 时
     *
     * 调用此接口不需要进行额外操作。
     *
     * #### 换取 token 身份验证方式为 client_secret_post 时
     *
     * 调用此接口时必须在 body 中传递 `client_id` 和 `client_secret` 参数，作为验证客户端身份的条件。其中 `client_id` 为应用 ID、`client_secret` 为应用密钥。
     *
     * #### 换取 token 身份验证方式为 client_secret_basic 时
     *
     * 调用此接口时必须在 HTTP 请求头中携带 `authorization` 请求头，作为验证客户端身份的条件。`authorization` 请求头的格式如下（其中 `client_id` 为应用 ID、`client_secret` 为应用密钥。）：
     *
     * ```
     * Basic base64(<client_id>:<client_secret>)
     * ```
     *
     * 结果示例：
     *
     * ```
     * Basic NjA2M2ZiMmYzY3h4eHg2ZGY1NWYzOWViOjJmZTdjODdhODFmODY3eHh4eDAzMjRkZjEyZGFlZGM3
     * ```
     *
     * JS 代码示例：
     *
     * ```js
     * 'Basic ' + Buffer.from(client_id + ':' + client_secret).toString('base64');
     * ```
     *
     * </details>
     *
     *
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string extIdpConnidentifier 必须，外部身份源连接标志符
     * @param 'apple' | 'wechat' | 'alipay' | 'wechatwork' | 'wechatwork_agency' | 'lark_internal' | 'lark_public' | 'yidun' | 'wechat_mini_program_code' | 'wechat_mini_program_phone' | 'google' connection 必须，移动端社会化登录类型：
     * - `apple`: Apple 移动端应用
     * - `wechat`: 微信移动应用
     * - `alipay`: 支付宝移动应用
     * - `wechatwork`: 企业微信移动应用
     * - `wechatwork_agency`: 企业微信移动应用（代开发模式）
     * - `lark_internal`: 飞书移动端企业自建应用
     * - `lark_public`: 飞书移动端应用商店应用
     * - `yidun`: 网易易盾一键登录
     * - `wechat_mini_program_code`: 微信小程序使用 code 登录
     * - `wechat_mini_program_phone `: 微信小程序使用手机号登录
     * - `google`: Google 移动端社会化登录
     *
     * @param SignInByWechatPayloadDto wechatPayload 可选，苹果移动端社会化登录数据，当 `connection` 为 `wechat` 的时候必填。，默认 null
     * @param SignInByApplePayloadDto applePayload 可选，微信移动端社会化登录数据，当 `connection` 为 `apple` 的时候必填。，默认 null
     * @param SignInByAlipayPayloadDto alipayPayload 可选，支付宝移动端社会化登录数据，当 `connection` 为 `alipay` 的时候必填。，默认 null
     * @param SignInByWechatworkDto wechatworkPayload 可选，企业微信移动端社会化登录数据，当 `connection` 为 `wechatwork` 的时候必填。，默认 null
     * @param SignInByWechatworkAgencyPayloadDto wechatworkAgencyPayload 可选，企业微信（代开发模式）移动端社会化登录数据，当 `connection` 为 `wechatwork_agency` 的时候必填。，默认 null
     * @param SignInByLarkPublicPayloadDto larkPublicPayload 可选，飞书应用商店应用移动端社会化登录数据，当 `connection` 为 `lark_public` 的时候必填。，默认 null
     * @param SignInByLarkInternalPayloadDto larkInternalPayload 可选，飞书自建应用移动端社会化登录数据，当 `connection` 为 `lark_internal` 的时候必填。，默认 null
     * @param SignInByYidunPayloadDto yidunPayload 可选，网易易盾移动端社会化登录数据，当 `connection` 为 `yidun` 的时候必填。，默认 null
     * @param SignInByWechatMiniProgramCodePayloadDto wechatMiniProgramCodePayload 可选，网易易盾移动端社会化登录数据，当 `connection` 为 `wechat_mini_program_code` 的时候必填。，默认 null
     * @param SignInByWechatMiniProgramPhonePayloadDto wechatMiniProgramPhonePayload 可选，网易易盾移动端社会化登录数据，当 `connection` 为 `wechat_mini_program_phone` 的时候必填。，默认 null
     * @param SignInByGooglePayloadDto googlePayload 可选，Google 移动端社会化登录数据，当 `connection` 为 `google` 的时候必填。，默认 null
     * @param SignInByMobileOptionsDto options 可选，可选参数，默认 null
     * @param string client_id 可选，应用 ID。当应用的「换取 token 身份验证方式」配置为 `client_secret_post` 需要传。，默认 null
     * @param string client_secret 可选，应用密钥。当应用的「换取 token 身份验证方式」配置为 `client_secret_post` 需要传。，默认 null
     * @return LoginTokenRespDto
     */
    public function signInByMobile($option = array())
    {
        // 组装请求
        $varPost = array(
            "extIdpConnidentifier" => Util\Tool::getOrDefault($option, "extIdpConnidentifier", null),
            "connection" => Util\Tool::getOrDefault($option, "connection", null),
            "wechatPayload" => Util\Tool::getOrDefault($option, "wechatPayload", null),
            "applePayload" => Util\Tool::getOrDefault($option, "applePayload", null),
            "alipayPayload" => Util\Tool::getOrDefault($option, "alipayPayload", null),
            "wechatworkPayload" => Util\Tool::getOrDefault($option, "wechatworkPayload", null),
            "wechatworkAgencyPayload" => Util\Tool::getOrDefault($option, "wechatworkAgencyPayload", null),
            "larkPublicPayload" => Util\Tool::getOrDefault($option, "larkPublicPayload", null),
            "larkInternalPayload" => Util\Tool::getOrDefault($option, "larkInternalPayload", null),
            "yidunPayload" => Util\Tool::getOrDefault($option, "yidunPayload", null),
            "wechatMiniProgramCodePayload" => Util\Tool::getOrDefault($option, "wechatMiniProgramCodePayload", null),
            "wechatMiniProgramPhonePayload" => Util\Tool::getOrDefault($option, "wechatMiniProgramPhonePayload", null),
            "googlePayload" => Util\Tool::getOrDefault($option, "googlePayload", null),
            "options" => Util\Tool::getOrDefault($option, "options", null),
            "client_id" => Util\Tool::getOrDefault($option, "client_id", null),
            "client_secret" => Util\Tool::getOrDefault($option, "client_secret", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/signin-by-mobile", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取支付宝 AuthInfo
     * @summary 获取支付宝 AuthInfo
     * @description 此接口用于获取发起支付宝认证需要的[初始化参数 AuthInfo](https://opendocs.alipay.com/open/218/105325)。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string extIdpConnidentifier 必须，外部身份源连接标志符
     * @return GetAlipayAuthInfoRespDto
     */
    public function getAlipayAuthInfo($option = array())
    {
        // 组装请求
        $varGet = array(
            "extIdpConnidentifier" => Util\Tool::getOrDefault($option, "extIdpConnidentifier", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-alipay-authinfo", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 生成用于登录的二维码
     * @summary 生成用于登录的二维码
     * @description 生成用于登录的二维码，目前支持生成微信公众号扫码登录、小程序扫码登录、自建移动 APP 扫码登录的二维码。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'MOBILE_APP' | 'WECHAT_MINIPROGRAM' | 'WECHAT_OFFICIAL_ACCOUNT' type 必须，二维码类型。当前支持三种类型：
     * - `MOBILE_APP`: 自建移动端 APP 扫码
     * - `WECHAT_MINIPROGRAM`: 微信小程序扫码
     * - `WECHAT_OFFICIAL_ACCOUNT` 关注微信公众号扫码
     * @param string extIdpConnId 可选，当 `type` 为 `WECHAT_MINIPROGRAM` 或 `WECHAT_OFFICIAL_ACCOUNT` 时，可以指定身份源连接，否则默认使用应用开启的第一个对应身份源连接生成二维码。，默认 null
     * @param any customData 可选，当 `type` 为 `MOBILE_APP` 时，可以传递用户的自定义数据，当用户成功扫码授权时，会将此数据存入用户的自定义数据。，默认 null
     * @param any context 可选，当 type 为 `WECHAT_OFFICIAL_ACCOUNT` 或 `WECHAT_MINIPROGRAM` 时，指定自定义的 pipeline 上下文，将会传递的 pipeline 的 context 中，默认 null
     * @param boolean autoMergeQrCode 可选，当 type 为 `WECHAT_MINIPROGRAM` 时，是否将自定义的 logo 自动合并到生成的图片上，默认为 false。服务器合并二维码的过程会加大接口响应速度，推荐使用默认值，在客户端对图片进行拼接。如果你使用 Authing 的 SDK，可以省去手动拼接的过程。，默认 null
     * @return GeneQRCodeRespDto
     */
    public function geneQrCode($option = array())
    {
        // 组装请求
        $varPost = array(
            "type" => Util\Tool::getOrDefault($option, "type", null),
            "extIdpConnId" => Util\Tool::getOrDefault($option, "extIdpConnId", null),
            "customData" => Util\Tool::getOrDefault($option, "customData", null),
            "context" => Util\Tool::getOrDefault($option, "context", null),
            "autoMergeQrCode" => Util\Tool::getOrDefault($option, "autoMergeQrCode", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/gene-qrcode", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 查询二维码状态
     * @summary 查询二维码状态
     * @description 按照用户扫码顺序，共分为未扫码、已扫码等待用户确认、用户同意/取消授权、二维码过期以及未知错误六种状态，前端应该通过不同的状态给到用户不同的反馈。你可以通过下面这篇文章了解扫码登录详细的流程：https://docs.authing.cn/v2/concepts/how-qrcode-works.html.
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string qrcodeId 必须，二维码唯一 ID
     * @return CheckQRCodeStatusRespDto
     */
    public function checkQrCodeStatus($option = array())
    {
        // 组装请求
        $varGet = array(
            "qrcodeId" => Util\Tool::getOrDefault($option, "qrcodeId", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/check-qrcode-status", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 使用二维码 ticket 换取 TokenSet
     * @summary 使用二维码 ticket 换取 TokenSet
     * @description
     * 此端点为使用二维码的 ticket 换取用户的 `access_token` 和 `id_token`。
     *
     *
     * 注意事项：取决于你在 Authing 创建应用时选择的**应用类型**和应用配置的**换取 token 身份验证方式**，在调用此接口时需要对客户端的身份进行不同形式的验证。
     *
     * <details>
     * <summary>点击展开详情</summary>
     *
     * <br>
     *
     * 你可以在 [Authing 控制台](https://console.authing.cn) 的**应用** - **自建应用** - **应用详情** - **应用配置** - **其他设置** - **授权配置**
     * 中找到**换取 token 身份验证方式** 配置项：
     *
     * > 单页 Web 应用和客户端应用隐藏，默认为 `none`，不允许修改；后端应用和标准 Web 应用可以修改此配置项。
     *
     * ![](https://files.authing.co/api-explorer/tokenAuthMethod.jpg)
     *
     * #### 换取 token 身份验证方式为 none 时
     *
     * 调用此接口不需要进行额外操作。
     *
     * #### 换取 token 身份验证方式为 client_secret_post 时
     *
     * 调用此接口时必须在 body 中传递 `client_id` 和 `client_secret` 参数，作为验证客户端身份的条件。其中 `client_id` 为应用 ID、`client_secret` 为应用密钥。
     *
     * #### 换取 token 身份验证方式为 client_secret_basic 时
     *
     * 调用此接口时必须在 HTTP 请求头中携带 `authorization` 请求头，作为验证客户端身份的条件。`authorization` 请求头的格式如下（其中 `client_id` 为应用 ID、`client_secret` 为应用密钥。）：
     *
     * ```
     * Basic base64(<client_id>:<client_secret>)
     * ```
     *
     * 结果示例：
     *
     * ```
     * Basic NjA2M2ZiMmYzY3h4eHg2ZGY1NWYzOWViOjJmZTdjODdhODFmODY3eHh4eDAzMjRkZjEyZGFlZGM3
     * ```
     *
     * JS 代码示例：
     *
     * ```js
     * 'Basic ' + Buffer.from(client_id + ':' + client_secret).toString('base64');
     * ```
     *
     * </details>
     *
     *
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string ticket 必须，当二维码状态为已授权时返回。如果在控制台应用安全 - 通用安全 - 登录安全 - APP 扫码登录 Web 安全中未开启「Web 轮询接口返回完整用户信息」（默认处于关闭状态），会返回此 ticket，用于换取完整的用户信息。
     * @param string client_id 可选，应用 ID。当应用的「换取 token 身份验证方式」配置为 `client_secret_post` 需要传。，默认 null
     * @param string client_secret 可选，应用密钥。当应用的「换取 token 身份验证方式」配置为 `client_secret_post` 需要传。，默认 null
     * @return LoginTokenRespDto
     */
    public function exchangeTokenSetWithQrCodeTicket($option = array())
    {
        // 组装请求
        $varPost = array(
            "ticket" => Util\Tool::getOrDefault($option, "ticket", null),
            "client_id" => Util\Tool::getOrDefault($option, "client_id", null),
            "client_secret" => Util\Tool::getOrDefault($option, "client_secret", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/exchange-tokenset-with-qrcode-ticket", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 自建 APP 扫码登录：APP 端修改二维码状态
     * @summary 自建 APP 扫码登录：APP 端修改二维码状态
     * @description 此端点用于在自建 APP 扫码登录中修改二维码状态，对应着在浏览器渲染出二维码之后，终端用户扫码、确认授权、取消授权的过程。**此接口要求具备用户的登录态**。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'SCAN' | 'CONFIRM' | 'CANCEL' action 必须，修改二维码状态的动作:
     * - `SCAN`: 修改二维码状态为已扫码状态，当移动 APP 扫了码之后，应当立即执行此操作；
     * - `CONFIRM`: 修改二维码状态为已授权，执行此操作前必须先执行 `SCAN 操作；
     * - `CANCEL`: 修改二维码状态为已取消，执行此操作前必须先执行 `SCAN 操作；
     *
     * @param string qrcodeId 必须，二维码唯一 ID
     * @return CommonResponseDto
     */
    public function changeQrCodeStatus($option = array())
    {
        // 组装请求
        $varPost = array(
            "action" => Util\Tool::getOrDefault($option, "action", null),
            "qrcodeId" => Util\Tool::getOrDefault($option, "qrcodeId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/change-qrcode-status", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 发送短信
     * @summary 发送短信
     * @description 发送短信时必须指定短信 Channel，每个手机号同一 Channel 在一分钟内只能发送一次。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'CHANNEL_LOGIN' | 'CHANNEL_REGISTER' | 'CHANNEL_RESET_PASSWORD' | 'CHANNEL_BIND_PHONE' | 'CHANNEL_UNBIND_PHONE' | 'CHANNEL_BIND_MFA' | 'CHANNEL_VERIFY_MFA' | 'CHANNEL_UNBIND_MFA' | 'CHANNEL_COMPLETE_PHONE' | 'CHANNEL_IDENTITY_VERIFICATION' | 'CHANNEL_DELETE_ACCOUNT' channel 必须，短信通道，指定发送此短信的目的：
     * - `CHANNEL_LOGIN`: 用于用户登录
     * - `CHANNEL_REGISTER`: 用于用户注册
     * - `CHANNEL_RESET_PASSWORD`: 用于重置密码
     * - `CHANNEL_BIND_PHONE`: 用于绑定手机号
     * - `CHANNEL_UNBIND_PHONE`: 用于解绑手机号
     * - `CHANNEL_BIND_MFA`: 用于绑定 MFA
     * - `CHANNEL_VERIFY_MFA`: 用于验证 MFA
     * - `CHANNEL_UNBIND_MFA`: 用于解绑 MFA
     * - `CHANNEL_COMPLETE_PHONE`: 用于在注册/登录时补全手机号信息
     * - `CHANNEL_IDENTITY_VERIFICATION`: 用于进行用户实名认证
     * - `CHANNEL_DELETE_ACCOUNT`: 用于注销账号
     *
     * @param string phoneNumber 必须，手机号，不带区号。如果是国外手机号，请在 phoneCountryCode 参数中指定区号。
     * @param string phoneCountryCode 可选，手机区号，中国大陆手机号可不填。Authing 短信服务暂不内置支持国际手机号，你需要在 Authing 控制台配置对应的国际短信服务。完整的手机区号列表可参阅 https://en.wikipedia.org/wiki/List_of_country_calling_codes。，默认 null
     * @return SendSMSRespDto
     */
    public function sendSms($option = array())
    {
        // 组装请求
        $varPost = array(
            "channel" => Util\Tool::getOrDefault($option, "channel", null),
            "phoneNumber" => Util\Tool::getOrDefault($option, "phoneNumber", null),
            "phoneCountryCode" => Util\Tool::getOrDefault($option, "phoneCountryCode", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/send-sms", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 发送邮件
     * @summary 发送邮件
     * @description 发送邮件时必须指定邮件 Channel，每个邮箱同一 Channel 在一分钟内只能发送一次。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'CHANNEL_LOGIN' | 'CHANNEL_REGISTER' | 'CHANNEL_RESET_PASSWORD' | 'CHANNEL_VERIFY_EMAIL_LINK' | 'CHANNEL_UPDATE_EMAIL' | 'CHANNEL_BIND_EMAIL' | 'CHANNEL_UNBIND_EMAIL' | 'CHANNEL_VERIFY_MFA' | 'CHANNEL_UNLOCK_ACCOUNT' | 'CHANNEL_COMPLETE_EMAIL' | 'CHANNEL_DELETE_ACCOUNT' channel 必须，短信通道，指定发送此短信的目的：
     * - `CHANNEL_LOGIN`: 用于用户登录
     * - `CHANNEL_REGISTER`: 用于用户注册
     * - `CHANNEL_RESET_PASSWORD`: 用于重置密码
     * - `CHANNEL_VERIFY_EMAIL_LINK`: 用于验证邮箱地址
     * - `CHANNEL_UPDATE_EMAIL`: 用于修改邮箱
     * - `CHANNEL_BIND_EMAIL`: 用于绑定邮箱
     * - `CHANNEL_UNBIND_EMAIL`: 用于解绑邮箱
     * - `CHANNEL_VERIFY_MFA`: 用于验证 MFA
     * - `CHANNEL_UNLOCK_ACCOUNT`: 用于自助解锁
     * - `CHANNEL_COMPLETE_EMAIL`: 用于注册/登录时补全邮箱信息
     * - `CHANNEL_DELETE_ACCOUNT`: 用于注销账号
     *
     * @param string email 必须，邮箱，不区分大小写
     * @return SendEmailRespDto
     */
    public function sendEmail($option = array())
    {
        // 组装请求
        $varPost = array(
            "channel" => Util\Tool::getOrDefault($option, "channel", null),
            "email" => Util\Tool::getOrDefault($option, "email", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/send-email", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户资料
     * @summary 获取用户资料
     * @description 此端点用户获取用户资料，需要在请求头中带上用户的 `access_token`，Authing 服务器会根据用户 `access_token` 中的 `scope` 返回对应的字段。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @param boolean withIdentities 可选，是否获取 identities，默认 false
     * @param boolean withDepartmentIds 可选，是否获取部门 ID 列表，默认 false
     * @return UserSingleRespDto
     */
    public function getProfile($option = array())
    {
        // 组装请求
        $varGet = array(
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
            "withIdentities" => Util\Tool::getOrDefault($option, "withIdentities", null),
            "withDepartmentIds" => Util\Tool::getOrDefault($option, "withDepartmentIds", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-profile", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改用户资料
     * @summary 修改用户资料
     * @description 此接口用于修改用户的用户资料，包含用户的自定义数据。如果需要**修改邮箱**、**修改手机号**、**修改密码**，请使用对应的单独接口。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string name 可选，用户真实名称，不具备唯一性，默认 null
     * @param string nickname 可选，昵称，默认 null
     * @param string photo 可选，头像链接，默认 null
     * @param string externalId 可选，第三方外部 ID，默认 null
     * @param string birthdate 可选，出生日期，默认 null
     * @param string country 可选，所在国家，默认 null
     * @param string province 可选，所在省份，默认 null
     * @param string city 可选，所在城市，默认 null
     * @param string address 可选，所处地址，默认 null
     * @param string streetAddress 可选，所处街道地址，默认 null
     * @param string postalCode 可选，邮政编码号，默认 null
     * @param 'M' | 'F' | 'U' gender 可选，性别，默认 null
     * @param string username 可选，用户名，用户池内唯一，默认 null
     * @param any customData 可选，自定义数据，传入的对象中的 key 必须先在用户池定义相关自定义字段，默认 null
     * @return UserSingleRespDto
     */
    public function updateProfile($option = array())
    {
        // 组装请求
        $varPost = array(
            "name" => Util\Tool::getOrDefault($option, "name", null),
            "nickname" => Util\Tool::getOrDefault($option, "nickname", null),
            "photo" => Util\Tool::getOrDefault($option, "photo", null),
            "externalId" => Util\Tool::getOrDefault($option, "externalId", null),
            "birthdate" => Util\Tool::getOrDefault($option, "birthdate", null),
            "country" => Util\Tool::getOrDefault($option, "country", null),
            "province" => Util\Tool::getOrDefault($option, "province", null),
            "city" => Util\Tool::getOrDefault($option, "city", null),
            "address" => Util\Tool::getOrDefault($option, "address", null),
            "streetAddress" => Util\Tool::getOrDefault($option, "streetAddress", null),
            "postalCode" => Util\Tool::getOrDefault($option, "postalCode", null),
            "gender" => Util\Tool::getOrDefault($option, "gender", null),
            "username" => Util\Tool::getOrDefault($option, "username", null),
            "customData" => Util\Tool::getOrDefault($option, "customData", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-profile", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 绑定邮箱
     * @summary 绑定邮箱
     * @description 如果用户还**没有绑定邮箱**，此接口可用于用户**自主**绑定邮箱。如果用户已经绑定邮箱想要修改邮箱，请使用**修改邮箱**接口。你需要先调用**发送邮件**接口发送邮箱验证码。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string passCode 必须，邮箱验证码，一个邮箱验证码只能使用一次，且有一定有效时间。
     * @param string email 必须，邮箱，不区分大小写。
     * @return CommonResponseDto
     */
    public function bindEmail($option = array())
    {
        // 组装请求
        $varPost = array(
            "passCode" => Util\Tool::getOrDefault($option, "passCode", null),
            "email" => Util\Tool::getOrDefault($option, "email", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/bind-email", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 解绑邮箱
     * @summary 解绑邮箱
     * @description 用户解绑邮箱，如果用户没有绑定其他登录方式（手机号、社会化登录账号），将无法解绑邮箱，会提示错误。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string passCode 必须，邮箱验证码，需要先调用**发送邮件**接口接收验证码。
     * @return CommonResponseDto
     */
    public function unbindEmail($option = array())
    {
        // 组装请求
        $varPost = array(
            "passCode" => Util\Tool::getOrDefault($option, "passCode", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/unbind-email", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 绑定手机号
     * @summary 绑定手机号
     * @description 如果用户还**没有绑定手机号**，此接口可用于用户**自主**绑定手机号。如果用户已经绑定手机号想要修改手机号，请使用**修改手机号**接口。你需要先调用**发送短信**接口发送短信验证码。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string passCode 必须，短信验证码，注意一个短信验证码指南使用一次，且有过期时间。
     * @param string phoneNumber 必须，手机号，不带区号。如果是国外手机号，请在 phoneCountryCode 参数中指定区号。
     * @param string phoneCountryCode 可选，手机区号，中国大陆手机号可不填。Authing 短信服务暂不内置支持国际手机号，你需要在 Authing 控制台配置对应的国际短信服务。完整的手机区号列表可参阅 https://en.wikipedia.org/wiki/List_of_country_calling_codes。，默认 null
     * @return CommonResponseDto
     */
    public function bindPhone($option = array())
    {
        // 组装请求
        $varPost = array(
            "passCode" => Util\Tool::getOrDefault($option, "passCode", null),
            "phoneNumber" => Util\Tool::getOrDefault($option, "phoneNumber", null),
            "phoneCountryCode" => Util\Tool::getOrDefault($option, "phoneCountryCode", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/bind-phone", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 解绑手机号
     * @summary 解绑手机号
     * @description 用户解绑手机号，如果用户没有绑定其他登录方式（邮箱、社会化登录账号），将无法解绑手机号，会提示错误。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string passCode 必须，短信验证码，需要先调用**发送短信**接口接收验证码。
     * @return CommonResponseDto
     */
    public function unbindPhone($option = array())
    {
        // 组装请求
        $varPost = array(
            "passCode" => Util\Tool::getOrDefault($option, "passCode", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/unbind-phone", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取密码强度和账号安全等级评分
     * @summary 获取密码强度和账号安全等级评分
     * @description 获取用户的密码强度和账号安全等级评分，需要在请求头中带上用户的 `access_token`。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return GetSecurityInfoRespDto
     */
    public function getSecurityLevel($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-security-info", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改密码
     * @summary 修改密码
     * @description 此端点用于用户自主修改密码，如果用户之前已经设置密码，需要提供用户的原始密码作为凭证。如果用户忘记了当前密码，请使用**忘记密码**接口。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string newPassword 必须，新密码
     * @param string oldPassword 可选，原始密码，如果用户当前设置了密码，此参数必填。，默认 null
     * @param 'sm2' | 'rsa' | 'none' passwordEncryptType 可选，密码加密类型，支持使用 RSA256 和国密 SM2 算法进行加密。默认为 `none` 不加密。
     * - `none`: 不对密码进行加密，使用明文进行传输。
     * - `rsa`: 使用 RSA256 算法对密码进行加密，需要使用 Authing 服务的 RSA 公钥进行加密，请阅读**介绍**部分了解如何获取 Authing 服务的 RSA256 公钥。
     * - `sm2`: 使用 [国密 SM2 算法](https://baike.baidu.com/item/SM2/15081831) 对密码进行加密，需要使用 Authing 服务的 SM2 公钥进行加密，请阅读**介绍**部分了解如何获取 Authing 服务的 SM2 公钥。
     * ，默认 null
     * @return CommonResponseDto
     */
    public function updatePassword($option = array())
    {
        // 组装请求
        $varPost = array(
            "newPassword" => Util\Tool::getOrDefault($option, "newPassword", null),
            "oldPassword" => Util\Tool::getOrDefault($option, "oldPassword", null),
            "passwordEncryptType" => Util\Tool::getOrDefault($option, "passwordEncryptType", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-password", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 发起修改邮箱的验证请求
     * @summary 发起修改邮箱的验证请求
     * @description 终端用户自主修改邮箱时，需要提供相应的验证手段。此接口用于验证用户的修改邮箱请求是否合法。当前支持通过**邮箱验证码**的方式进行验证，你需要先调用发送邮件接口发送对应的邮件验证码。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param UpdateEmailByEmailPassCodeDto emailPassCodePayload 必须，使用邮箱验证码方式验证的数据
     * @param 'EMAIL_PASSCODE' verifyMethod 必须，修改当前邮箱使用的验证手段：
     * - `EMAIL_PASSCODE`: 通过邮箱验证码进行验证，当前只支持这种验证方式。
     *
     * @return VerifyUpdateEmailRequestRespDto
     */
    public function verifyUpdateEmailRequest($option = array())
    {
        // 组装请求
        $varPost = array(
            "emailPassCodePayload" => Util\Tool::getOrDefault($option, "emailPassCodePayload", null),
            "verifyMethod" => Util\Tool::getOrDefault($option, "verifyMethod", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/verify-update-email-request", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改邮箱
     * @summary 修改邮箱
     * @description 终端用户自主修改邮箱，需要提供相应的验证手段，见[发起修改邮箱的验证请求](#tag/用户资料/修改邮箱/operation/ProfileV3Controller_updateEmailVerification)。
     * 此参数需要提供一次性临时凭证 `updateEmailToken`，此数据需要从**发起修改邮箱的验证请求**接口获取。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string updateEmailToken 必须，用于临时修改邮箱的 token，可从**发起修改邮箱的验证请求**接口获取。
     * @return CommonResponseDto
     */
    public function updateEmail($option = array())
    {
        // 组装请求
        $varPost = array(
            "updateEmailToken" => Util\Tool::getOrDefault($option, "updateEmailToken", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-email", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 发起修改手机号的验证请求
     * @summary 发起修改手机号的验证请求
     * @description 终端用户自主修改手机号时，需要提供相应的验证手段。此接口用于验证用户的修改手机号请求是否合法。当前支持通过**短信验证码**的方式进行验证，你需要先调用发送短信接口发送对应的短信验证码。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param UpdatePhoneByPhonePassCodeDto phonePassCodePayload 必须，使用手机号验证码方式验证的数据
     * @param 'PHONE_PASSCODE' verifyMethod 必须，修改手机号的验证方式：
     * - `PHONE_PASSCODE`: 使用短信验证码的方式进行验证，当前仅支持这一种方式。
     *
     * @return VerifyUpdatePhoneRequestRespDto
     */
    public function verifyUpdatePhoneRequest($option = array())
    {
        // 组装请求
        $varPost = array(
            "phonePassCodePayload" => Util\Tool::getOrDefault($option, "phonePassCodePayload", null),
            "verifyMethod" => Util\Tool::getOrDefault($option, "verifyMethod", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/verify-update-phone-request", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改手机号
     * @summary 修改手机号
     * @description 终端用户自主修改手机号，需要提供相应的验证手段，见[发起修改手机号的验证请求](#tag/用户资料/修改邮箱/operation/ProfileV3Controller_updatePhoneVerification)。
     * 此参数需要提供一次性临时凭证 `updatePhoneToken`，此数据需要从**发起修改手机号的验证请求**接口获取。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string updatePhoneToken 必须，用于临时修改手机号的 token，可从**发起修改手机号的验证请求**接口获取。
     * @return CommonResponseDto
     */
    public function updatePhone($option = array())
    {
        // 组装请求
        $varPost = array(
            "updatePhoneToken" => Util\Tool::getOrDefault($option, "updatePhoneToken", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-phone", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 发起忘记密码请求
     * @summary 发起忘记密码请求
     * @description 当用户忘记密码时，可以通过此端点找回密码。用户需要使用相关验证手段进行验证，目前支持**邮箱验证码**和**手机号验证码**两种验证手段。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'EMAIL_PASSCODE' | 'PHONE_PASSCODE' verifyMethod 必须，忘记密码请求使用的验证手段：
     * - `EMAIL_PASSCODE`: 通过邮箱验证码进行验证
     * - `PHONE_PASSCODE`: 通过手机号验证码进行验证
     *
     * @param ResetPasswordByPhonePassCodeDto phonePassCodePayload 可选，使用手机号验证码验证的数据，默认 null
     * @param ResetPasswordByEmailPassCodeDto emailPassCodePayload 可选，使用邮箱验证码验证的数据，默认 null
     * @return PasswordResetVerifyResp
     */
    public function verifyResetPasswordRequest($option = array())
    {
        // 组装请求
        $varPost = array(
            "verifyMethod" => Util\Tool::getOrDefault($option, "verifyMethod", null),
            "phonePassCodePayload" => Util\Tool::getOrDefault($option, "phonePassCodePayload", null),
            "emailPassCodePayload" => Util\Tool::getOrDefault($option, "emailPassCodePayload", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/verify-reset-password-request", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 忘记密码
     * @summary 忘记密码
     * @description 此端点用于用户忘记密码之后，通过**手机号验证码**或者**邮箱验证码**的方式重置密码。此接口需要提供用于重置密码的临时凭证 `passwordResetToken`，此参数需要通过**发起忘记密码请求**接口获取。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string password 必须，密码
     * @param string passwordResetToken 必须，重置密码的 token
     * @param 'sm2' | 'rsa' | 'none' passwordEncryptType 可选，密码加密类型，支持使用 RSA256 和国密 SM2 算法进行加密。默认为 `none` 不加密。
     * - `none`: 不对密码进行加密，使用明文进行传输。
     * - `rsa`: 使用 RSA256 算法对密码进行加密，需要使用 Authing 服务的 RSA 公钥进行加密，请阅读**介绍**部分了解如何获取 Authing 服务的 RSA256 公钥。
     * - `sm2`: 使用 [国密 SM2 算法](https://baike.baidu.com/item/SM2/15081831) 对密码进行加密，需要使用 Authing 服务的 SM2 公钥进行加密，请阅读**介绍**部分了解如何获取 Authing 服务的 SM2 公钥。
     * ，默认 null
     * @return IsSuccessRespDto
     */
    public function resetPassword($option = array())
    {
        // 组装请求
        $varPost = array(
            "password" => Util\Tool::getOrDefault($option, "password", null),
            "passwordResetToken" => Util\Tool::getOrDefault($option, "passwordResetToken", null),
            "passwordEncryptType" => Util\Tool::getOrDefault($option, "passwordEncryptType", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/reset-password", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 发起注销账号请求
     * @summary 发起注销账号请求
     * @description 当用户希望注销账号时，需提供相应凭证，当前支持**使用邮箱验证码**、使用**手机验证码**、**使用密码**三种验证方式。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'PHONE_PASSCODE' | 'EMAIL_PASSCODE' | 'PASSWORD' verifyMethod 必须，注销账号的验证手段：
     * - `PHONE_PASSCODE`: 使用手机号验证码方式进行验证。
     * - `EMAIL_PASSCODE`: 使用邮箱验证码方式进行验证。
     * - `PASSWORD`: 如果用户既没有绑定手机号又没有绑定邮箱，可以使用密码作为验证手段。
     *
     * @param DeleteAccountByPhonePassCodeDto phonePassCodePayload 可选，使用手机号验证码验证的数据，默认 null
     * @param DeleteAccountByEmailPassCodeDto emailPassCodePayload 可选，使用邮箱验证码验证的数据，默认 null
     * @param DeleteAccountByPasswordDto passwordPayload 可选，使用密码验证的数据，默认 null
     * @return VerifyDeleteAccountRequestRespDto
     */
    public function verifyDeleteAccountRequest($option = array())
    {
        // 组装请求
        $varPost = array(
            "verifyMethod" => Util\Tool::getOrDefault($option, "verifyMethod", null),
            "phonePassCodePayload" => Util\Tool::getOrDefault($option, "phonePassCodePayload", null),
            "emailPassCodePayload" => Util\Tool::getOrDefault($option, "emailPassCodePayload", null),
            "passwordPayload" => Util\Tool::getOrDefault($option, "passwordPayload", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/verify-delete-account-request", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 注销账户
     * @summary 注销账户
     * @description 此端点用于用户自主注销账号，需要提供用于注销账号的临时凭证 deleteAccountToken，此参数需要通过**发起注销账号请求**接口获取。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string deleteAccountToken 必须，注销账户的 token
     * @return IsSuccessRespDto
     */
    public function deleteAccount($option = array())
    {
        // 组装请求
        $varPost = array(
            "deleteAccountToken" => Util\Tool::getOrDefault($option, "deleteAccountToken", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/delete-account", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取服务器公开信息
     * @summary 获取服务器公开信息
     * @description 可端点可获取服务器的公开信息，如 RSA256 公钥、SM2 公钥、Authing 服务版本号等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return SystemInfoResp
     */
    public function getSystemInfo($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/system", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取国家列表
     * @summary 获取国家列表
     * @description 动态获取国家列表，可以用于前端登录页面国家选择和国际短信输入框选择，以减少前端静态资源体积。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return GetCountryListRespDto
     */
    public function getCountryList($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-country-list", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 预检验验证码是否正确
     * @summary 预检验验证码是否正确
     * @description 预检测验证码是否有效，此检验不会使得验证码失效。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'SMS' | 'EMAIL' codeType 必须，验证码类型
     * @param PreCheckSmsCodeDto smsCodePayload 可选，短信验证码检验参数，默认 null
     * @param PreCheckEmailCodeDto emailCodePayload 可选，邮箱验证码检验参数，默认 null
     * @return PreCheckCodeRespDto
     */
    public function preCheckCode($option = array())
    {
        // 组装请求
        $varPost = array(
            "codeType" => Util\Tool::getOrDefault($option, "codeType", null),
            "smsCodePayload" => Util\Tool::getOrDefault($option, "smsCodePayload", null),
            "emailCodePayload" => Util\Tool::getOrDefault($option, "emailCodePayload", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/pre-check-code", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 发起绑定 MFA 认证要素请求
     * @summary 发起绑定 MFA 认证要素请求
     * @description 当用户未绑定某个 MFA 认证要素时，可以发起绑定 MFA 认证要素请求。不同类型的 MFA 认证要素绑定请求需要发送不同的参数，详细见 profile 参数。发起验证请求之后，Authing 服务器会根据相应的认证要素类型和传递的参数，使用不同的手段要求验证。此接口会返回 enrollmentToken，你需要在请求「绑定 MFA 认证要素」接口时带上此 enrollmentToken，并提供相应的凭证。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param FactorProfile profile 必须，MFA 认证要素详细信息
     * @param 'OTP' | 'SMS' | 'EMAIL' | 'FACE' factorType 必须，MFA 认证要素类型：
     * - `OTP`: OTP
     * - `SMS`: 短信
     * - `EMAIL`: 邮件
     * - `FACE`: 人脸
     *
     * @return SendEnrollFactorRequestRespDto
     */
    public function sendEnrollFactorRequest($option = array())
    {
        // 组装请求
        $varPost = array(
            "profile" => Util\Tool::getOrDefault($option, "profile", null),
            "factorType" => Util\Tool::getOrDefault($option, "factorType", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/send-enroll-factor-request", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 绑定 MFA 认证要素
     * @summary 绑定 MFA 认证要素
     * @description 绑定 MFA 要素
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param EnrollFactorEnrollmentDataDto enrollmentData 必须，绑定 MFA 认证要素时，对应认证要素要求的验证信息。
     * @param string enrollmentToken 必须，「发起绑定 MFA 认证要素请求」接口返回的 enrollmentToken，此 token 有效时间为一分钟。
     * @param 'OTP' | 'SMS' | 'EMAIL' | 'FACE' factorType 必须，MFA 认证要素类型：
     * - `OTP`: OTP
     * - `SMS`: 短信
     * - `EMAIL`: 邮件
     * - `FACE`: 人脸
     *
     * @return EnrollFactorRespDto
     */
    public function enrollFactor($option = array())
    {
        // 组装请求
        $varPost = array(
            "enrollmentData" => Util\Tool::getOrDefault($option, "enrollmentData", null),
            "enrollmentToken" => Util\Tool::getOrDefault($option, "enrollmentToken", null),
            "factorType" => Util\Tool::getOrDefault($option, "factorType", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/enroll-factor", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 解绑 MFA 认证要素
     * @summary 解绑 MFA 认证要素
     * @description 当前不支持通过此接口解绑短信、邮箱验证码类型的认证要素。如果需要，请调用「解绑邮箱」和「解绑手机号」接口。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string factorId 必须，MFA 认证要素 ID
     * @return ResetFactorRespDto
     */
    public function resetFactor($option = array())
    {
        // 组装请求
        $varPost = array(
            "factorId" => Util\Tool::getOrDefault($option, "factorId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/reset-factor", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取绑定的所有 MFA 认证要素
     * @summary 获取绑定的所有 MFA 认证要素
     * @description Authing 目前支持四种类型的 MFA 认证要素：手机短信、邮件验证码、OTP、人脸。如果用户绑定了手机号 / 邮箱之后，默认就具备了手机短信、邮箱验证码的 MFA 认证要素。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return ListEnrolledFactorsRespDto
     */
    public function listEnrolledFactors($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-enrolled-factors", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取绑定的某个 MFA 认证要素
     * @summary 获取绑定的某个 MFA 认证要素
     * @description 根据 Factor ID 获取用户绑定的某个 MFA Factor 详情。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string factorId 必须，MFA Factor ID
     * @return GetFactorRespDto
     */
    public function getFactor($option = array())
    {
        // 组装请求
        $varGet = array(
            "factorId" => Util\Tool::getOrDefault($option, "factorId", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-factor", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取可绑定的 MFA 认证要素
     * @summary 获取可绑定的 MFA 认证要素
     * @description 获取所有应用已经开启、用户暂未绑定的 MFA 认证要素，用户可以从返回的列表中绑定新的 MFA 认证要素。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return ListFactorsToEnrollRespDto
     */
    public function listFactorsToEnroll($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-factors-to-enroll", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 生成绑定外部身份源的链接
     * @summary 生成绑定外部身份源的链接
     * @description
     * 此接口用于生成绑定外部身份源的链接，生成之后可以引导用户进行跳转。
     *
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string extIdpConnIdentifier 必须，外部身份源连接唯一标志
     * @param string appId 必须，Authing 应用 ID
     * @param string idToken 必须，用户的 id_token
     * @return GenerateBindExtIdpLinkRespDto
     */
    public function generateLinkExtIdpUrl($option = array())
    {
        // 组装请求
        $varGet = array(
            "ext_idp_conn_identifier" => Util\Tool::getOrDefault($option, "extIdpConnIdentifier", null),
            "app_id" => Util\Tool::getOrDefault($option, "appId", null),
            "id_token" => Util\Tool::getOrDefault($option, "idToken", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/generate-link-extidp-url", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 解绑外部身份源
     * @summary 解绑外部身份源
     * @description 解绑外部身份源，此接口需要传递用户绑定的外部身份源 ID，**注意不是身份源连接 ID**。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string extIdpId 必须，外部身份源 ID
     * @return CommonResponseDto
     */
    public function unlinkExtIdp($option = array())
    {
        // 组装请求
        $varPost = array(
            "extIdpId" => Util\Tool::getOrDefault($option, "extIdpId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/unlink-extidp", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取绑定的外部身份源
     * @summary 获取绑定的外部身份源
     * @description
     * 如在**介绍**部分中所描述的，一个外部身份源对应多个外部身份源连接，用户通过某个外部身份源连接绑定了某个外部身份源账号之后，
     * 用户会建立一条与此外部身份源之间的关联关系。此接口用于获取此用户绑定的所有外部身份源。
     *
     * 取决于外部身份源的具体实现，一个用户在外部身份源中，可能会有多个身份 ID，比如在微信体系中会有 `openid` 和 `unionid`，在非书中有
     * `open_id`、`union_id` 和 `user_id`。在 Authing 中，我们把这样的一条 `open_id` 或者 `unionid_` 叫做一条 `Identity`， 所以用户在一个身份源会有多条 `Identity` 记录。
     *
     * 以微信为例，如果用户使用微信登录或者绑定了微信账号，他的 `Identity` 信息如下所示：
     *
     * ```json
     * [
     * {
     * "identityId": "62f20932xxxxbcc10d966ee5",
     * "extIdpId": "62f209327xxxxcc10d966ee5",
     * "provider": "wechat",
     * "type": "openid",
     * "userIdInIdp": "oH_5k5SflrwjGvk7wqpoBKq_cc6M",
     * "originConnIds": ["62f2093244fa5cb19ff21ed3"]
     * },
     * {
     * "identityId": "62f726239xxxxe3285d21c93",
     * "extIdpId": "62f209327xxxxcc10d966ee5",
     * "provider": "wechat",
     * "type": "unionid",
     * "userIdInIdp": "o9Nka5ibU-lUGQaeAHqu0nOZyJg0",
     * "originConnIds": ["62f2093244fa5cb19ff21ed3"]
     * }
     * ]
     * ```
     *
     *
     * 可以看到他们的 `extIdpId` 是一样的，这个是你在 Authing 中创建的**身份源 ID**；`provider` 都是 `wechat`；
     * 通过 `type` 可以区分出哪个是 `openid`，哪个是 `unionid`，以及具体的值（`userIdInIdp`）；他们都来自于同一个身份源连接（`originConnIds`）。
     *
     *
     *
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return GetIdentitiesRespDto
     */
    public function getIdentities($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-identities", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取应用开启的外部身份源列表
     * @summary 获取应用开启的外部身份源列表
     * @description 获取应用开启的外部身份源列表，前端可以基于此渲染外部身份源按钮。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return GetExtIdpsRespDto
     */
    public function getApplicationEnabledExtIdps($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-application-enabled-extidps", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 注册
     * @summary 注册
     * @description
     * 此端点目前支持以下几种基于的注册方式：
     *
     * 1. 基于密码（PASSWORD）：用户名 + 密码，邮箱 + 密码。
     * 2. 基于一次性临时验证码（PASSCODE）：手机号 + 验证码，邮箱 + 验证码。你需要先调用发送短信或者发送邮件接口获取验证码。
     *
     * 社会化登录等使用外部身份源“注册”请直接使用**登录**接口，我们会在其第一次登录的时候为其创建一个新账号。
     *
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'PASSWORD' | 'PASSCODE' connection 必须，注册方式：
     * - `PASSWORD`: 邮箱密码方式
     * - `PASSCODE`: 邮箱/手机号验证码方式
     *
     * @param SignUpByPasswordDto passwordPayload 可选，当注册方式为 `PASSWORD` 时此参数必填。，默认 null
     * @param SignUpByPassCodeDto passCodePayload 可选，当认证方式为 `PASSCODE` 时此参数必填，默认 null
     * @param SignUpProfileDto profile 可选，用户资料，默认 null
     * @param SignUpOptionsDto options 可选，可选参数，默认 null
     * @return UserSingleRespDto
     */
    public function signUp($option = array())
    {
        // 组装请求
        $varPost = array(
            "connection" => Util\Tool::getOrDefault($option, "connection", null),
            "passwordPayload" => Util\Tool::getOrDefault($option, "passwordPayload", null),
            "passCodePayload" => Util\Tool::getOrDefault($option, "passCodePayload", null),
            "profile" => Util\Tool::getOrDefault($option, "profile", null),
            "options" => Util\Tool::getOrDefault($option, "options", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/signup", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 解密微信小程序数据
     * @summary 解密微信小程序数据
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，`wx.login` 接口返回的用户 `code`
     * @param string iv 必须，对称解密算法初始向量，由微信返回
     * @param string encryptedData 必须，获取微信开放数据返回的加密数据（encryptedData）
     * @param string extIdpConnidentifier 必须，微信小程序的外部身份源连接标志符
     * @return DecryptWechatMiniProgramDataRespDto
     */
    public function decryptWechatMiniProgramData($option = array())
    {
        // 组装请求
        $varPost = array(
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "iv" => Util\Tool::getOrDefault($option, "iv", null),
            "encryptedData" => Util\Tool::getOrDefault($option, "encryptedData", null),
            "extIdpConnidentifier" => Util\Tool::getOrDefault($option, "extIdpConnidentifier", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/decrypt-wechat-miniprogram-data", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取小程序的手机号
     * @summary 获取小程序的手机号
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，`open-type=getphonecode` 接口返回的 `code`
     * @param string extIdpConnidentifier 必须，微信小程序的外部身份源连接标志符
     * @return GetWechatMiniProgramPhoneRespDto
     */
    public function getWechatMiniprogramPhone($option = array())
    {
        // 组装请求
        $varPost = array(
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "extIdpConnidentifier" => Util\Tool::getOrDefault($option, "extIdpConnidentifier", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/get-wechat-miniprogram-phone", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取 Authing 服务器缓存的微信小程序、公众号 Access Token
     * @summary 获取 Authing 服务器缓存的微信小程序、公众号 Access Token
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string appSecret 必须，微信小程序或微信公众号的 AppSecret
     * @param string appId 必须，微信小程序或微信公众号的 AppId
     * @return GetWechatAccessTokenRespDto
     */
    public function getWechatMpAccessToken($option = array())
    {
        // 组装请求
        $varPost = array(
            "appSecret" => Util\Tool::getOrDefault($option, "appSecret", null),
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/get-wechat-access-token", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取登录日志
     * @summary 获取登录日志
     * @description 获取登录日志
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string appId 可选，应用 ID，可根据应用 ID 筛选。默认不传获取所有应用的登录历史。
     * @param string clientIp 可选，客户端 IP，可根据登录时的客户端 IP 进行筛选。默认不传获取所有登录 IP 的登录历史。
     * @param boolean success 可选，是否登录成功，可根据是否登录成功进行筛选。默认不传获取的记录中既包含成功也包含失败的的登录历史。
     * @param number start 可选，开始时间，为单位为毫秒的时间戳
     * @param number end 可选，结束时间，为单位为毫秒的时间戳
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @return GetLoginHistoryRespDto
     */
    public function getLoginHistory($option = array())
    {
        // 组装请求
        $varGet = array(
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
            "clientIp" => Util\Tool::getOrDefault($option, "clientIp", null),
            "success" => Util\Tool::getOrDefault($option, "success", null),
            "start" => Util\Tool::getOrDefault($option, "start", null),
            "end" => Util\Tool::getOrDefault($option, "end", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-my-login-history", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取登录应用
     * @summary 获取登录应用
     * @description 获取登录应用
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return GetLoggedInAppsRespDto
     */
    public function getLoggedInApps($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-my-logged-in-apps", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取具备访问权限的应用
     * @summary 获取具备访问权限的应用
     * @description 获取具备访问权限的应用
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return GetAccessibleAppsRespDto
     */
    public function getAccessibleApps($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-my-accessible-apps", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取租户列表
     * @summary 获取租户列表
     * @description 获取租户列表
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return GetTenantListRespDto
     */
    public function getTenantList($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-my-tenant-list", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取角色列表
     * @summary 获取角色列表
     * @description 获取角色列表
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string namespace 可选，所属权限分组的 code
     * @return RoleListRespDto
     */
    public function getRoleList($option = array())
    {
        // 组装请求
        $varGet = array(
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-my-role-list", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取分组列表
     * @summary 获取分组列表
     * @description 获取分组列表
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return GroupListRespDto
     */
    public function getGroupList($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-my-group-list", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取部门列表
     * @summary 获取部门列表
     * @description 此接口用于获取用户的部门列表，可根据一定排序规则进行排序。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param boolean withCustomData 可选，是否获取部门的自定义数据，默认 false
     * @param 'DepartmentCreatedAt' | 'JoinDepartmentAt' | 'DepartmentName' | 'DepartmemtCode' sortBy 可选，排序依据，如 部门创建时间、加入部门时间、部门名称、部门标志符，默认 'JoinDepartmentAt'
     * @param 'Asc' | 'Desc' orderBy 可选，增序或降序，默认 'Desc'
     * @return UserDepartmentPaginatedRespDto
     */
    public function getDepartmentList($option = array())
    {
        // 组装请求
        $varGet = array(
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
            "sortBy" => Util\Tool::getOrDefault($option, "sortBy", null),
            "orderBy" => Util\Tool::getOrDefault($option, "orderBy", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-my-department-list", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取被授权的资源列表
     * @summary 获取被授权的资源列表
     * @description 此接口用于获取用户被授权的资源列表。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string namespace 可选，所属权限分组的 code
     * @param 'DATA' | 'API' | 'MENU' | 'BUTTON' | 'UI' resourceType 可选，资源类型，如 数据、API、菜单、按钮
     * @return AuthorizedResourcePaginatedRespDto
     */
    public function getAuthorizedResources($option = array())
    {
        // 组装请求
        $varGet = array(
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
            "resourceType" => Util\Tool::getOrDefault($option, "resourceType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-my-authorized-resources", $varGet, null);
        // 返回
        return $varRes["body"];
    }


// ==== AUTO GENERATED AUTHENTICATION METHODS END ====

}
