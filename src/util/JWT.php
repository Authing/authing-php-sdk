<?php

/**
 * Json Web Token
 */
class JWT
{

    //头部
    private static $header = array(
        "alg" => "HS256", //算法
        "typ" => "JWT"    //类型
    );

    //使用HMAC生成信息摘要时所使用的密钥
    private static $key = "123456";

    /**
     * 获取token
     * @param array $payload jwt载荷，格式如下非必须
     * [
     *  "iss"=>"jwt_admin",  //该JWT的签发者
     *  "iat"=>time(),  //签发时间
     *  "exp"=>time()+7200,  //过期时间
     *  "nbf"=>time()+60,  //该时间之前不接收处理该token
     *  "sub"=>"www.admin.com",  //面向的用户
     *  "jti"=>md5(uniqid("JWT").time())  //该token唯一标识
     * ]
     */
    public static function getToken($payload)
    {
        if (is_array($payload)) {
            $base64header = self::base64UrlEncode(json_encode(self::$header, JSON_UNESCAPED_UNICODE));
            $base64payload = self::base64UrlEncode(json_encode($payload, JSON_UNESCAPED_UNICODE));
            $token = $base64header . "." . $base64payload . "." . self::signature($base64header . "." . $base64payload, self::$key, self::$header["alg"]);
            return $token;
        } else {
            return false;
        }
    }

    /**
     * 解析token
     * @param string $token 需要解析的token
     */
    public static function parseToken($token)
    {
        //分解
        $tokens = explode(".", $token);

        //数量
        if (count($tokens) != 3) return false;

        //赋值
        list($base64header, $base64payload, $sign) = $tokens;

        //获取算法
        $base64decodeheader = json_decode(self::base64UrlDecode($base64header), JSON_OBJECT_AS_ARRAY);
        if (empty($base64decodeheader["alg"])) return false;

        //组装
        $payload = json_decode(self::base64UrlDecode($base64payload), JSON_OBJECT_AS_ARRAY);

        //返回
        return $payload;
    }

    /**
     * 验证token
     * @param string $token 需要验证的token
     */
    public static function verifyToken($token)
    {
        //分解
        $tokens = explode(".", $token);

        //数量
        if (count($tokens) != 3) return false;

        //赋值
        list($base64header, $base64payload, $sign) = $tokens;

        //获取算法
        $base64decodeheader = json_decode(self::base64UrlDecode($base64header), JSON_OBJECT_AS_ARRAY);
        if (empty($base64decodeheader["alg"])) return false;

        //签名验证
        if (self::signature($base64header . "." . $base64payload, self::$key, $base64decodeheader["alg"]) !== $sign) return false;

        //组装
        $payload = json_decode(self::base64UrlDecode($base64payload), JSON_OBJECT_AS_ARRAY);

        //签发时间大于当前服务器时间验证失败
        if (isset($payload["iat"]) && $payload["iat"] > time()) return false;

        //过期时间小于当前服务器时间验证失败
        if (isset($payload["exp"]) && $payload["exp"] < time()) return false;

        //该nbf时间之前不接收处理该token
        if (isset($payload["nbf"]) && $payload["nbf"] > time()) return false;

        //返回
        return $payload;
    }

    /**
     * base64UrlEncode
     * @param string $input 需要编码的字符串
     */
    public static function base64UrlEncode($input)
    {
        return str_replace("=", "", strtr(base64_encode($input), "+/", "-_"));
    }

    /**
     * base64UrlEncode
     * @param string $input 需要解码的字符串
     */
    public static function base64UrlDecode($input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $addlen = 4 - $remainder;
            $input .= str_repeat("=", $addlen);
        }
        return base64_decode(strtr($input, "-_", "+/"));
    }

    /**
     * HMACSHA256签名
     * @param string $input base64UrlEncode(header).".".base64UrlEncode(payload)
     * @param string $key
     * @param string $alg 算法方式
     */
    private static function signature($input, $key, $alg = "HS256")
    {
        $alg_config = array(
            "HS256" => "sha256"
        );
        return self::base64UrlEncode(hash_hmac($alg_config[$alg], $input, $key, true));
    }
}
