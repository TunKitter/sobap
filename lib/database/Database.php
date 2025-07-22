<?php
class Database
{
    private static $db;
    private function __construct()
    {
    }
    private function __clone()
    {
    }
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }
    private static function getInstance()
    {
        if (!isset(static::$db)) {
            $host = getenv('MYSQL_HOST');
            $user = getenv('MYSQL_USERNAME');
            $db = getenv('MYSQL_DATABASE');
            $pass = getenv('MYSQL_PASSWORD');
            $port = getenv('MYSQL_PORT');
            try {
                static::$db = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
                static::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                static::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (\Throwable $th) {
               return handleExceptionWithDebug(1);
            }
        }
        return static::$db;
    }
    public static function getMany(string $table, $limit = null)
    {
        if (Validate::from($table)->alphaNumeric()->validate()['is_error']) return handleExceptionWithDebug(1);
        $sql = "SELECT * FROM $table";
        if ($limit != null)
            $sql .= " LIMIT $limit";
        try {
            return Database::getInstance()->query($sql)->fetchAll();
        } catch (\Throwable $th) {
            return handleExceptionWithDebug(1);
        }
    }
}
$a = Database::getMany('orders', 4);
var_dump($a);