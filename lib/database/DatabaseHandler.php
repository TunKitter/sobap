<?php
class DatabaseHandler
{
    public function __construct(private array $sql, private array $statement)
    {
        $this->sql = $sql;
        $this->statement = $statement;
    }
    public function getStatement()
    {
        return $this->statement;
    }
    public function __call($method, $args)
    {
        if (array_search($method, $this->sql) !== false) {
            if (!function_exists($method)) include __DIR__ . DIRECTORY_SEPARATOR . "units" . DIRECTORY_SEPARATOR . "$method.php";
            $return = $method($args, $this->statement);
            if ($return !== null) return $return;
            return new DatabaseHandler($this->sql, $this->statement);
        } else throw new Exception("Invalid statement");
    }
}