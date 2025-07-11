<?php
require_once getenv('ROOT_DIR') . "/lib/Request.php";
class Route
{
    private static $instance;
    public $route = [];
    public static function getInstance()
    {
        if (!isset(static::$instance)) static::$instance = new Route();
        return static::$instance;
    }
    public function addEndpoint($url, callable $condition, callable $callback)
    {
        $url = trim($url, '/');
        $escapedUrl = preg_quote($url, '#');
        preg_match_all("/{\w+}/", $url, $demo);
        $pattern = preg_replace("/\\\\\{[\w\-]+\\\\\}/", "([^\/]+)", $escapedUrl);
        static::$instance->route[] = [
            $pattern,
            array_map(function ($str) {
                return substr($str, 1, strlen($str) - 2);
            }, $demo[0]),
            $condition,
            $callback
        ];
    }
    public static function __callStatic($method, $args)
    {
        $file = __DIR__ . "\\implementation\\$method.php";
        if (!file_exists($file)) exit("<span style='color:red'>The <b>$method</b> method doesn't exist</span>");
        return $method::handle($args);
    }
    public function __destruct()
    {
        $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $data = array_find(static::$instance->route, function ($value) use (&$matches, $url) {
            return preg_match("#^" . $value[0] . "$#", $url, $matches) && $value[2]();
        });
        if ($matches) array_shift($matches);
        if (!$data) exit("Not found bro");
        $request = new Request();
        $request->setParam(array_combine($data[1], $matches));
        $data[3]($request);
    }
    # prevent initialization
    private function __construct() {}
    # prevent cloning
    private function __clone() {}
    # prevent unserialization
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }
}