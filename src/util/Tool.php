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
    public static function getSet($parData, $parDefault = null)
    {
        return isset($parData) ? $parData : $parDefault;
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
    public static function request($parUrl, $parGet = [], $parPost = [], $parHeader = [], $parCookie = [])
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
        if (Tool::isJson($tempBody)) $tempBody = json_decode($tempBody, true);
        $varRes["body"] = $tempBody;
        //组装-cookie
        preg_match_all("/set\-cookie:([^\r\n]*)/i", $varRes["header"], $tempCookie);
        $tempCookie = implode(";", $tempCookie[1]);
        $varRes["cookie"] = !empty($tempCookie) ? trim($tempCookie) : "";
        //返回
        curl_close($varCurlObject);
        return $varRes;
    }
}
