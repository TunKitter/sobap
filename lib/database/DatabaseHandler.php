<?php
class DatabaseHandler
{
    public function __construct(private array $sql, private array $statement)
    {
    }
    public function getStatement()
    {
        return $this->statement;
    }
    public function __call($method, $args)
    {
        if (in_array($method, $this->sql)) {
            if (!function_exists("sobap_sql_$method")) include __DIR__ . DIRECTORY_SEPARATOR . "units" . DIRECTORY_SEPARATOR . "$method.php";
            $method = "sobap_sql_$method";
            $return = $method($args, $this->statement);
            if ($return !== null) return $return;
            return new DatabaseHandler($this->sql, $this->statement);
        } else throw new Exception("Invalid statement");
    }
}