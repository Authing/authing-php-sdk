<?php

/**
 * 命名空间
 */

namespace Authing\Util;

/**
 * 工具
 */
class Tool
{

   public static function RandomString($length = 32)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * 获取非空数据
     */
    public static function getNotEmpty($parData, $parDefault = null)
    {
        return !empty($parData) ? $parData : $parDefault;
    }

    /**
     * 获取已赋值数据
     */
    public static function getOrDefault($parObj, $parKey, $parDefault = null)
    {
        return isset($parObj[$parKey]) ? $parObj[$parKey] : $parDefault;
    }

    /**
     * 获取URL参数
     */
    public static function getUrlParam($parUrl, $parKey)
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
     * 是否为JSON数据
     */
    public static function isJson($parString)
    {
        json_decode($parString);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * 规范数据
     */
    public static function formatData($varData)
    {
        foreach ($varData as $forKey => $forValue) {
            if ($forValue === null) {
                unset($varData[$forKey]);
            }
        }
        return $varData;
    }

    /**
     * 请求HTTP
     */
    public static function request($parMethod, $parUrl, $parGet = [], $parPost = [], $parHeader = [], $parTimeout = 10)
    {
        // 使用 CURL 发送请求
        $varCurlObject = curl_init();

        // 配置 CURL 基础设置
        curl_setopt($varCurlObject, CURLOPT_URL, $parUrl); // 配置URL
        curl_setopt($varCurlObject, CURLOPT_CONNECTTIMEOUT, $parTimeout); // 连接前等待时间
        curl_setopt($varCurlObject, CURLOPT_TIMEOUT, $parTimeout); // 连接后等待时间
        curl_setopt($varCurlObject, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4); // 使用IPv4协议
        curl_setopt($varCurlObject, CURLOPT_RETURNTRANSFER, true); // 返回文件流
        curl_setopt($varCurlObject, CURLOPT_HEADER, true); // 返回Header
        curl_setopt($varCurlObject, CURLOPT_ENCODING, ""); // 支持所有编码
        curl_setopt($varCurlObject, CURLOPT_FOLLOWLOCATION, true); // 跟踪重定向
        curl_setopt($varCurlObject, CURLOPT_MAXREDIRS, 10); // 指定重定向的最大值
        curl_setopt($varCurlObject, CURLOPT_AUTOREFERER, true); // 自动配置Referer
        curl_setopt($varCurlObject, CURLOPT_SSL_VERIFYPEER, false); // 禁止校验对等证书
        curl_setopt($varCurlObject, CURLOPT_SSL_VERIFYHOST, false); // 禁止校验域名与证书的一致性
        curl_setopt($varCurlObject, CURLOPT_USERAGENT, "AuthingIdentityCloud php"); // 配置UserAgent

        // GET 请求
        if ($parMethod == "GET") {
            // 如果设置了 get 请求的参数
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
                // 将 query 部分补充到 url 中
                curl_setopt($varCurlObject, CURLOPT_URL, $parUrl . "?" . implode("&", $varGet));
            }
        }

        // POST 请求
        if ($parMethod == "POST") {
            // 标记 CURLOPT_POST 为 true
            curl_setopt($varCurlObject, CURLOPT_POST, true);
            // 如果设置了 post 请求的参数
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
                // 将 post 参数设置到 body 中
                curl_setopt($varCurlObject, CURLOPT_POSTFIELDS, $parPost);
            }
        }

        // 配置额外请求头
        if ($parHeader != []) {
            foreach ($parHeader as $forKey => $forValue) {
                $varHeader[] = "$forKey: $forValue";
            }
            curl_setopt($varCurlObject, CURLOPT_HTTPHEADER, $varHeader);
        }

        // 执行请求
        $tempCurlRes = curl_exec($varCurlObject);

        // 封装返回结果
        $varRes["error"] = curl_error($varCurlObject);
        $varRes["code"] = curl_getinfo($varCurlObject, CURLINFO_HTTP_CODE);
        $tempHeaderSize = curl_getinfo($varCurlObject, CURLINFO_HEADER_SIZE);
        $varRes["header"]  = trim(substr($tempCurlRes, 0, $tempHeaderSize));
        $tempBody = substr($tempCurlRes, $tempHeaderSize);
        if (Tool::isJson($tempBody)) $tempBody = json_decode($tempBody, true);
        $varRes["body"] = $tempBody;
        preg_match_all("/set\-cookie:([^\r\n]*)/i", $varRes["header"], $tempCookie);
        $tempCookie = implode(";", $tempCookie[1]);
        $varRes["cookie"] = !empty($tempCookie) ? trim($tempCookie) : "";

        // 返回最终结果
        curl_close($varCurlObject);
        return $varRes;
    }
}
