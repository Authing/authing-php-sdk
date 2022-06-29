<?php

/**
 * 命名空间
 */

namespace Authing\Util;

/**
 * Json Web Token
 */
class JWT
{
    /**
     * 签名
     * @param string $data header + payload
     * @param string $key 密钥
     * @param string $alg 算法
     */
    private static function _signature($data, $key, $alg = "HS256")
    {
        $alg_config = array(
            "HS256" => "sha256",
        );
        return self::base64UrlEncode(hash_hmac($alg_config[$alg], $data, $key, true));
    }

    /**
     * 解析Token
     * @param string $token 需要被解析的token
     * @param string $key 密钥，为空则不进行验证
     */
    public static function parseToken($token, $key = null)
    {
        //分割
        $tokens = explode(".", $token);
        if (count($tokens) != 3) return false;
        list($base64header, $base64payload, $signA) = $tokens;

        //解析数据
        $payload = json_decode(self::base64UrlDecode($base64payload), JSON_OBJECT_AS_ARRAY);

        //验证
        if ($key !== null) {
            //签名验证
            $base64decodeheader = json_decode(self::base64UrlDecode($base64header), JSON_OBJECT_AS_ARRAY);
            if (empty($base64decodeheader["alg"])) return false;
            $signB = self::_signature($base64header . "." . $base64payload, $key, $base64decodeheader["alg"]);
            if ($signB !== $signA) return false;

            //签发时间不能大于当前服务器时间
            if (isset($payload["iat"]) && $payload["iat"] > time()) return false;

            //过期时间不能小于当前服务器时间
            if (isset($payload["exp"]) && $payload["exp"] < time()) return false;

            //未来时间不能大于当前服务器时间
            if (isset($payload["nbf"]) && $payload["nbf"] > time()) return false;
        }

        //返回
        return $payload;
    }

    /**
     * Base64与URL编码
     * @param string $data 需要编码的数据
     */
    public static function base64UrlEncode($data)
    {
        return str_replace("=", "", strtr(base64_encode($data), "+/", "-_"));
    }

    /**
     * Base64与URL解码
     * @param string $data 需要解码的数据
     */
    public static function base64UrlDecode($data)
    {
        $remainder = strlen($data) % 4;
        if ($remainder) {
            $addlen = 4 - $remainder;
            $data .= str_repeat("=", $addlen);
        }
        return base64_decode(strtr($data, "-_", "+/"));
    }
}
