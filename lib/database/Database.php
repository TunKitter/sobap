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
    public static function getMany(string $table,string $where = '', $limit = null)
    {
        $sql = "SELECT * FROM $table";
        if ($where !== '')
            $sql .= " WHERE $where";
        if ($limit !== null)
            $sql .= " LIMIT $limit";
        try {
            return Database::getInstance()->query($sql)->fetchAll();
        } catch (\Throwable $th) {
            return handleExceptionWithDebug(1);
        }
    }
    public static function getOne(string $table, string $where)
    {
        try {
            return Database::getInstance()->query("SELECT * FROM $table WHERE $where LIMIT 1")->fetch();
        } catch (\Throwable $th) {
            return handleExceptionWithDebug(1);
        }
    }
}
$a = Database::getOne('orders', "OrderID = 10248");
var_dump($a);