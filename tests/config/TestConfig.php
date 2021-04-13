<?php 
namespace Test;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class TestConfig {
    static function getConfig(string $moduleName) {
        $config = Yaml::parseFile(__DIR__.'/test.yaml');
        return $config[$moduleName];
    }
}