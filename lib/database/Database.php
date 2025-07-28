<?php
class Database
{
    private static PDO $instance;
    private function __construct() {}
    private function __clone() {}
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $host = getenv('MYSQL_HOST');
            $user = getenv('MYSQL_USERNAME');
            $db = getenv('MYSQL_DATABASE');
            $pass = getenv('MYSQL_PASSWORD');
            $port = getenv('MYSQL_PORT');
            self::$instance = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass, [PDO::ATTR_PERSISTENT => true]);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return self::$instance;
    }
    public static function __callStatic($method, $args)
    {
        require_once __DIR__ . DIRECTORY_SEPARATOR . "statements" . DIRECTORY_SEPARATOR . "$method.php";
        return $method(...$args);
    }
}