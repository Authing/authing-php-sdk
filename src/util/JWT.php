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
     * @param string $data header . payload
     * @param string $key 密钥
     * @param string $alg 算法
     */
    private static function _signature($data, $key, $alg = "HS256")
    {
        switch ($alg) {
            case "HS256":
                $ret = self::base64UrlEncode(hash_hmac("sha256", $data, $key, true));
                break;
            default:
                $ret = self::base64UrlEncode(hash_hmac("sha256", $data, $key, true));
                break;
        }
        return $ret;
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
        list($base64Header, $base64Payload, $signature) = $tokens;

        //解析
        $header = json_decode(self::base64UrlDecode($base64Header), JSON_OBJECT_AS_ARRAY);
        $payload = json_decode(self::base64UrlDecode($base64Payload), JSON_OBJECT_AS_ARRAY);

        //验证
        if ($key !== null) {
            //签名验证
            if ($signature !== self::_signature($base64Header . "." . $base64Payload, $key, $header["alg"])) return false;

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
