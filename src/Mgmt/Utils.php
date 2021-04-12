<?php

namespace Authing\Mgmt;

use Authing\Types\UDFDataType;

class Utils
{
    public static function convertUdv(array $data)
    {
        foreach ($data as $item) {
            $dataType = $item->dataType;
            $value = $item->value;
            if ($dataType === UDFDataType::NUMBER) {
                $item->value = json_encode($value);
            } else if ($dataType === UDFDataType::BOOLEAN) {
                $item->value = json_encode($value);
            } else if ($dataType === UDFDataType::DATETIME) {
                // set data time
                // $item->value = intval($value);
            } else if ($dataType === UDFDataType::OBJECT) {
                $item->value = json_encode($value);
            }
        }
        return $data;
    }
}
