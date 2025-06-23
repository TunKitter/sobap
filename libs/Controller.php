<?php
class Controller
{

    public static function _($method)
    {
        return fn() => (static::$instance)->{$method}();
    }
    public static function setup()
    {
        static::$instance = new static();
    }
}