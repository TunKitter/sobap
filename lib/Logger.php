<?php
class Logger
{
    public static function __callStatic($method, $args)
    {
        if (!method_exists(Logger::class, $method)) {
            $args[0] = "Method \"$method\" does not exist";
            $method = "error";
        }
        Logger::$method($args[0]);
        $file = fopen(__DIR__ . "/../logs/main.log", "a+");
        fwrite($file, date("Y-m-d H:i:s") . " " . $args[0] . " [". strtoupper($method) ."]\n");
        fclose($file);
        if($method == "error") exit();
    }
    private static function info($message)
    {
        echo "\033[48;5;27;38;5;231m 🚀 $message \033[0m\n";
    }
    private static function success($message)
    {
        echo "\033[34;42m 🎉 $message \033[0m\n";
    }
    private static function error($message)
    {
        echo "\033[48;5;88;38;5;196m 😈 $message \033[0m\n";
    }
}