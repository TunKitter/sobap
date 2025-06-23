<?php
require_once "libs/system/request.php";
class Controller
{
    use Request;
    public static function _($method)
    {
        return fn() => (static::$instance)->{$method}(static::getRequestData());
    }
    public static function setup()
    {
        static::$instance = new static();
    }
}