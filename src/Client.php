<?php
/**
 * Created by PhpStorm.
 * User: haoweilai
 * Date: 2018/4/30
 * Time: 下午10:35
 */

namespace Authing;


class Client
{

    private $options = [];

    private $_ownerToken = '';

    private $_userToken = '';

    private $_oauthUrl = 'https://oauth.authing.cn/graphql';

    private $_usersUrl = 'https://users.authing.cn/graphql';


    private const PUBLIC_KEY
        = <<<PUBLICKKEY
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC4xKeUgQ+Aoz7TLfAfs9+paePb
5KIofVthEopwrXFkp8OCeocaTHt9ICjTT2QeJh6cZaDaArfZ873GPUn00eOIZ7Ae
+TiA2BKHbCvloW3w5Lnqm70iSsUi5Fmu9/2+68GZRH9L7Mlh8cFksCicW2Y2W2uM
GKl64GDcIq3au+aqJQIDAQAB
-----END PUBLIC KEY-----
PUBLICKKEY;

    /**
     * Client constructor.
     * @param $options
     * @throws \Authing\InvalidArgumentException
     * @throws \Exception
     */
    public function __construct($options)
    {
        $this->options = $this->createOptions($options);
        //obtain accessToken
        $this->getAccessToken();
    }

    /**
     * Check the right of the options
     * @throws \Exception
     */
    private function getAccessToken()
    {
        $query
              = <<<'QUERY'
query getAccessTokenByAppSecret($id: String!, $secret: String!) {
  getAccessTokenByAppSecret(secret: $secret,clientId: $id)
  }
QUERY;
        $body = [
            "query"     => $query,
            "variables" => [
                'id'     => $this->options['clientId'],
                'secret' => $this->options['secret'],
            ],
        ];
        $res  = $this->getHttp($this->_usersUrl, $body);

        if ( !empty($res['data']['getAccessTokenByAppSecret']) ) {
            $this->_ownerToken = $res['data']['getAccessTokenByAppSecret'];
        } else {
            throw new InvalidArgumentException("wrong clientId or secret,please check again!!");
        }

    }

    /**
     * @param $options
     * @return mixed
     * @throws \Authing\InvalidArgumentException
     */
    private function createOptions($options)
    {
        if ( is_array($options) ) {
            if ( isset($options['clientId']) && isset($options['secret']) ) {
                return $options;
            }
        }
        throw new InvalidArgumentException("Invalid type for client options.");
    }

    /**
     * @param $params
     * @return mixed
     * @throws \Authing\InvalidArgumentException
     */
    private function checkParams($params)
    {
        if ( is_array($params) ) {
            foreach ( func_get_args() as $k => $v ) {
                if ( $k != 0 ) {
                    if ( !isset($params[$v])) {
                        throw new InvalidArgumentException(
                            "function args do not contain params {$v} and can not be null"
                        );
                    }
                }
            }
            return $params;
        }
        throw new InvalidArgumentException("wrong type of function args");
    }


    /**
     *  Login
     * @param array $params
     * @return mixed
     * @throws \Authing\InvalidArgumentException
     * @throws \Exception
     */
    public function login($params)
    {
        //check params is contain Specified key
        $params = $this->checkParams($params, 'email', 'password');
        $query
                = <<<'QUERY'
mutation login($unionid: String, $email: String, $password: String, $lastIP: String, $registerInClient: String!, $verifyCode: String) {
    login(unionid: $unionid, email: $email, password: $password, lastIP: $lastIP, registerInClient: $registerInClient, verifyCode: $verifyCode) {
        _id
        email
        emailVerified
        username
        nickname
        company
        photo
        browser
        token
        tokenExpiredAt
        loginsCount
        lastLogin
        lastIP
        signedUp
        blocked
        isDeleted
    }
}
QUERY;
        $body   = [
            "query"     => $query,
            "variables" => [
                'email'            => $params['email'],
                'password'         => self::passwordEncrypt($params['password']),
                'registerInClient' => $this->options['clientId'],
            ],
        ];
        $res    = $this->getHttp($this->_usersUrl, $body);
        if ( !empty($res['data']['token']) ) {
            $this->_userToken = $res['data']['token'];
        }
        return $res;

    }

    /**
     *  readOAuthList
     * @return mixed
     * @throws \Exception
     */
    public function ReadOAuthList()
    {

        $query = <<<'QUERY'
    query ReadOAuthList($clientId: String!) {
        ReadOauthList(clientId: $clientId) {
            _id
            name
            image
            description
            enabled
            client
            user
            url
        }
    }
QUERY;
        $body = [
            "query"     => $query,
            "variables" => [
                'clientId' => $this->options['clientId'],
            ],
        ];
        $res  = $this->getHttp($this->_oauthUrl, $body);
        return $res;

    }

    /**
     * user data
     * @param $params
     * @return mixed
     * @throws \Authing\InvalidArgumentException
     * @throws \Exception
     */
    public function user($params)
    {
        $params = $this->checkParams($params, 'id');
        $query = <<<'QUERY'
    query user($id: String!, $registerInClient: String!){
    user(id: $id, registerInClient: $registerInClient) {
        _id
        email
        emailVerified
        username
        nickname
        company
        photo
        browser
        registerInClient
        registerMethod
        oauth
        token
        tokenExpiredAt
        loginsCount
        lastLogin
        lastIP
        signedUp
        blocked
        isDeleted
    }

}
QUERY;
        $body = [
            "query"     => $query,
            "variables" => [
                'id' => $params['id'],
                'registerInClient' => $this->options['clientId'],
            ],
        ];
        $header = [
            'Authorization' => "Bearer {$this->_ownerToken}",

        ];
        $res  = $this->getHttp($this->_usersUrl, $body,$header);
        if ( !empty($res['data']['user']['token']) ) {
            $this->_userToken = $res['data']['user']['token'];
        }
        return $res;

    }

    /**users data
     * @param $params
     * @return mixed
     * @throws \Authing\InvalidArgumentException
     * @throws \Exception
     */
    public function users($params)
    {
        $params = $this->checkParams($params, 'page','count');
        $query = <<<'QUERY'
    query users($registerInClient: String, $page: Int, $count: Int){
  users(registerInClient: $registerInClient, page: $page, count: $count) {
    totalCount
    list {
      _id
      email
      emailVerified
      username
      nickname
      company
      photo
      browser
      password
      registerInClient
      token
      tokenExpiredAt
      loginsCount
      lastLogin
      lastIP
      signedUp
      blocked
      isDeleted
      group {
        _id
        name
        descriptions
        createdAt
      }
      clientType {
        _id
        name
        description
        image
        example
      }
      userLocation {
        _id
        when
        where
      }
      userLoginHistory {
        totalCount
        list{
          _id
          when
          success
          ip
          result
        }
      }
      systemApplicationType {
        _id
        name
        descriptions
        price
      }
    }
  }
}
QUERY;
        $body = [
            "query"     => $query,
            "variables" => [
                'page'  => $params['page'],
                'count' => $params['count'],
                'registerInClient' => $this->options['clientId'],
            ],
        ];
        $header = [
            'Authorization' => "Bearer {$this->_ownerToken}",

        ];
        $res  = $this->getHttp($this->_usersUrl, $body,$header);
        print_r($res);
        return $res;

    }

    /**
     * checkLoginStatus
     * @return mixed
     * @throws \Authing\InvalidArgumentException
     * @throws \Exception
     */
    public function checkLoginStatus($token='')
    {
        if ( empty($this->_userToken) ) {
            throw new InvalidArgumentException("user Token is null , please login first");
        }

        $query = <<<'QUERY'
    query checkLoginStatus {
    checkLoginStatus {
        status
        code
        message
    }
}
QUERY;
        $body = [
            "query"     => $query,
            "variables" => [
                'token' => $token
            ],
        ];
        $header = [
            'Authorization' => "Bearer {$this->_userToken}",

        ];
        $res  = $this->getHttp($this->_usersUrl, $body,$header);
        return $res;

    }


    /**
     * removeUsers
     * @param $params
     * @return mixed
     * @throws \Authing\InvalidArgumentException
     * @throws \Exception
     */
    public function removeUsers($params)
    {
        $params = $this->checkParams($params, 'ids');
        if ( !is_array($params['ids']) ) {
            throw new InvalidArgumentException("params['ids'] must be array");
        }
        $query = <<<'QUERY'
mutation removeUsers($ids: [String], $registerInClient: String, $operator: String){
  removeUsers(ids: $ids, registerInClient: $registerInClient, operator: $operator) {
    _id
  }
}
QUERY;
        $body = [
            "query"     => $query,
            "variables" => [
                'ids'              => $params['ids'],
                'registerInClient' => $this->options['clientId'],
            ],
        ];
        $header = [
            'Authorization' => "Bearer {$this->_ownerToken}",
        ];
        $res  = $this->getHttp($this->_usersUrl, $body,$header);
        return $res;
    }

    /**
     * sendVerifyEmail
     * @param array $params email
     * @return mixed
     * @throws \Authing\InvalidArgumentException
     * @throws \Exception
     */
    public function sendVerifyEmail($params)
    {
        $params = $this->checkParams($params, 'email');
        $query = <<<'QUERY'
mutation sendVerifyEmail(
    $email: String!,
    $client: String!
){
    sendVerifyEmail(
        email: $email,
        client: $client
    ) {
        message,
        code,
        status
    }
}
QUERY;
        $body = [
            "query"     => $query,
            "variables" => [
                'email'  => $params['email'],
                'client' => $this->options['clientId'],
            ],
        ];
        $header = [
            'Authorization' => "Bearer {$this->_ownerToken}",
        ];
        $res  = $this->getHttp($this->_usersUrl, $body,$header);
        return $res;
    }

    /**
     * sendResetPasswordEmail
     * @param array $params email
     * @return mixed
     * @throws \Authing\InvalidArgumentException
     * @throws \Exception
     */
    public function sendResetPasswordEmail($params)
    {
        $params = $this->checkParams($params, 'email');
        $query = <<<'QUERY'
mutation sendResetPasswordEmail(
    $email: String!,
    $client: String!
){
    sendResetPasswordEmail(
        email: $email,
        client: $client
    ) {
          message
          code
    }
}
QUERY;
        $body = [
            "query"     => $query,
            "variables" => [
                'email'  => $params['email'],
                'client' => $this->options['clientId'],
            ],
        ];
        $res  = $this->getHttp($this->_usersUrl, $body);
        return $res;
    }

    /**
     * verifyResetPasswordVerifyCode
     * @param array $params email
     * @return mixed
     * @throws \Authing\InvalidArgumentException
     * @throws \Exception
     */
    public function verifyResetPasswordVerifyCode($params)
    {
        $params = $this->checkParams($params, 'email','verifyCode');
        $query = <<<'QUERY'
mutation verifyResetPasswordVerifyCode(
    $email: String!,
    $client: String!,
    $verifyCode: String!
) {
    verifyResetPasswordVerifyCode(
        email: $email,
        client: $client,
        verifyCode: $verifyCode
    ) {
          message
          code
    }
}
QUERY;
        $body = [
            "query"     => $query,
            "variables" => [
                'email'      => $params['email'],
                'client'     => $this->options['clientId'],
                'verifyCode' => is_string($params['verifyCode'])?$params['verifyCode']:"{$params['verifyCode']}",
            ],
        ];

        $res  = $this->getHttp($this->_usersUrl, $body);
        return $res;
    }

    /**
     * verifyResetPasswordVerifyCode
     * @param array $params email
     * @return mixed
     * @throws \Authing\InvalidArgumentException
     * @throws \Exception
     */
    public function changePassword($params)
    {
        $params = $this->checkParams($params, 'email','verifyCode','password');
        $query = <<<'QUERY'
mutation changePassword(
    $email: String!,
    $client: String!,
    $password: String!,
    $verifyCode: String!
){
    changePassword(
        email: $email,
        client: $client,
        password: $password,
        verifyCode: $verifyCode
    ) {
        _id
        email
        emailVerified
        username
        nickname
        company
        photo
        browser
        registerInClient
        registerMethod
        oauth
        token
        tokenExpiredAt
        loginsCount
        lastLogin
        lastIP
        signedUp
        blocked
        isDeleted
    }
}
QUERY;
        $body = [
            "query"     => $query,
            "variables" => [
                'email'      => $params['email'],
                'client'     => $this->options['clientId'],
                'verifyCode' => is_string($params['verifyCode'])?$params['verifyCode']:"{$params['verifyCode']}",
                'password'   => self::passwordEncrypt($params['password']),
            ],
        ];
        $res  = $this->getHttp($this->_usersUrl, $body);
        print_r($res);
        return $res;
    }

    /**
     * @param string       $url    request url
     * @param string|array $data   post body
     * @param array        $header request header
     * @param int          $time   timeout time
     * @return mixed
     * @throws \Exception
     */
    private function getHttp($url, $data, $header = [], $time = 30000)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        curl_setopt($ch, CURLOPT_NOSIGNAL, true); //支持毫秒级别超时设置

        //set header
        $h = ["content-type: application/json"];
        foreach ( $header as $k => $v ) {
            $h[] = "$k: $v";
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $h);

        /*
          curl_setopt($ch, CURLOPT_SSLCERT, $this->config['cert']);
          curl_setopt($ch, CURLOPT_SSLCERTTYPE, $this->config['certtype']);
          curl_setopt($ch, CURLOPT_SSLKEY, $this->config['key']);

          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
         */
        if ( $data != '' ) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($data) ? json_encode($data) : $data);
        }

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 3000);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $time);

        $response = curl_exec($ch);


        if ( curl_errno($ch) === 0 ) {
            $info = curl_getinfo($ch);
            if ( !empty($info['http_code']) && $info['http_code'] == 200 ) {
                $res = json_decode($response, true);
                if ( json_last_error() == JSON_ERROR_NONE ) {
                    $return = $res;
                } else {
                    $return = $response;
                }
            } else {
                throw new \Exception(
                    "http response code not equal 200 return {$info['http_code']}, and the response body: {$response}"
                );
            }
            curl_close($ch);
            return $return;
        } else {
            curl_close($ch);
            $code  = curl_errno($ch);
            $error = curl_error($ch);
            throw new \Exception(
                "curl internal error, curlErrorCode is {$code},errorMsg: {$error}"

            );

        }
    }


    /**
     * register
     * @param array $params
     *                     ['unionid']          String,
     *                     ['email']            String,
     *                     ['password']         String,
     *                     ['lastIP']           String,
     *                     ['forceLogin']       Boolean,
     *                     ['oauth']            String,
     *                     ['username']         String,
     *                     ['nickname']         String,
     *                     ['registerMethod']   String,
     *                     ['photo']            String
     * @return mixed
     * @throws \Authing\InvalidArgumentException
     * @throws \Exception
     */
    public function register($params)
    {
        $params = $this->checkParams($params, 'email','password');
        $query = <<<'QUERY'
mutation register(
    $unionid: String,
    $email: String, 
    $password: String, 
    $lastIP: String, 
    $forceLogin: Boolean,
    $registerInClient: String!,
    $oauth: String,
    $username: String,
    $nickname: String,
    $registerMethod: String,
    $photo: String
) {
    register(userInfo: {
        unionid: $unionid,
        email: $email,
        password: $password,
        lastIP: $lastIP,
        forceLogin: $forceLogin,
        registerInClient: $registerInClient,
        oauth: $oauth,
        registerMethod: $registerMethod,
        photo: $photo,
        username: $username,
        nickname: $nickname
    }) {
        _id,
        email,
        emailVerified,
        username,
        nickname,
        company,
        photo,
        browser,
        password,
        token,
        group {
            name
        },
        blocked
    }
}
QUERY;
        $params['password'] = self::passwordEncrypt($params['password']);
        $params['registerInClient'] = $this->options['clientId'];
        $body = [
            "query"     => $query,
            "variables" => $params,
        ];
        $res  = $this->getHttp($this->_usersUrl, $body);
        return $res;
    }


    /**
     * updateUser
     * @param array $params
     *                     ['id']               String,
     *                     ['email']            String,
     *                     ['password']         String,
     *                     ['lastIP']           String,
     *                     ['forceLogin']       Boolean,
     *                     ['oauth']            String,
     *                     ['username']         String,
     *                     ['nickname']         String,
     *                     ['registerMethod']   String,
     *                     ['photo']            String
     * @return mixed
     * @throws \Authing\InvalidArgumentException
     * @throws \Exception
     */
    public function updateUser($params)
    {
        $params = $this->checkParams($params, 'id');
        $query = <<<'QUERY'
mutation UpdateUser(
    $_id: String!,
    $email: String,
    $emailVerified: Boolean,
    $username: String,
    $nickname: String,
    $company: String,
    $photo: String,
    $browser: String,
    $password: String,
    $oldPassword: String,
    $registerInClient: String!,
    $token: String,
    $tokenExpiredAt: String,
    $loginsCount: Int,
    $lastLogin: String,
    $lastIP: String,
    $signedUp: String,
    $blocked: Boolean,
    $isDeleted: Boolean
){
  updateUser(options: {
    _id: $_id,
    email: $email,
    emailVerified: $emailVerified,
    username: $username,
    nickname: $nickname,
    company: $company,
    photo: $photo,
    browser: $browser,
    password: $password,
    oldPassword: $oldPassword,
    registerInClient: $registerInClient,
    token: $token,
    tokenExpiredAt: $tokenExpiredAt,
    loginsCount: $loginsCount,
    lastLogin: $lastLogin,
    lastIP: $lastIP,
    signedUp: $signedUp,
    blocked: $blocked,
    isDeleted: $isDeleted
  }) {
    _id
    email
    emailVerified
    username
    nickname
    company
    photo
    browser
    registerInClient
    registerMethod
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    signedUp
    blocked
    isDeleted
  }
}
QUERY;
        $params['_id'] = $params['id'];
        unset($params['id']);
        if ( isset($params['password']) ) {
            $params['password'] = self::passwordEncrypt($params['password']);
        }
        $params['registerInClient'] = $this->options['clientId'];
        $body = [
            "query"     => $query,
            "variables" => $params,
        ];
        $header = [
            'Authorization' => "Bearer {$this->_ownerToken}",
        ];
        $res  = $this->getHttp($this->_usersUrl, $body,$header);
        return $res;
    }

    /**
     * password Encrypt
     * @param string $password
     * @return string
     */
    private static function passwordEncrypt($password)
    {
        $newPassword = '';
        openssl_public_encrypt($password, $newPassword, self::PUBLIC_KEY);
        return base64_encode($newPassword);
    }

}
