<?php

/**
 * 导入
 */

use Firebase\JWT\JWK as FirebaseJWK;
use Firebase\JWT\JWT as FirebaseJWT;
use Firebase\JWT\Key as FirebaseKey;

/**
 * Json Web Token
 */
class JWT
{
    /**
     * 解析JWKS
     * @param array $jwks 需要解析的jwks
     */
    public static function parseJWKS($jwks)
    {
        return FirebaseJWK::parseKeySet($jwks);
    }

    /**
     * 验证token
     * @param string $token 需要验证的token
     * @param string $key 使用HMAC生成信息摘要时所使用的密钥
     */
    public static function verifyToken($token, $key)
    {
        return FirebaseJWT::decode($token, new FirebaseKey($key, 'HS256'));
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
}
