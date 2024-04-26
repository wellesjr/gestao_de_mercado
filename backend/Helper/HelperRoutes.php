<?php 
namespace App\Helper;

class HelperRoutes {
    
    public static function getMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getUri() {
        return $_SERVER['REQUEST_URI'];
    }

    public static function getSegments() {
        $path = parse_url(self::getUri(), PHP_URL_PATH);
        return explode('/', trim($path, '/'));
    }

    public static function getApi() {
        return isset(self::getSegments()[0]) ? self::getSegments()[0] : '';
    }

    public static function getAction() {
        return isset(self::getSegments()[1]) ? self::getSegments()[1] : '';
    }

    public static function getParam() {
        return isset(self::getSegments()[2]) ? self::getSegments()[2] : '';
    }
}