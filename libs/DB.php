<?php
class DB
{
    private static DB $instance;
    public static function getInstance()
    {
        return static::$instance ?? static::$instance = new static();
    }
    private function __construct()
    {
        echo "I am new";
    }
    public function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=laragon;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
var_dump(DB::getInstance());
var_dump(DB::getInstance());
var_dump(DB::getInstance());
var_dump(DB::getInstance());