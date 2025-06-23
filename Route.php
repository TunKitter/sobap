<?php
class Route
{
    private static array $route = ['GET' => [], 'POST' => [], '404' => null];
    private static function checkExist($url, string $type)
    {
        $data = self::$route[$type];
        return ['status' => array_key_exists($url, $data), 'data' => $data[$url] ?? null];
    }
    public static function dispatch()
    {
        $t = self::checkExist($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
        if ($t['status'])
            $t['data']();
        else
            self::$route['404'] ? (self::$route['404'])() : print "Not found";
    }
    private static function addEndpoint(string $type, string $url, callable $callback)
    {
        self::$route[$type][$url] = $callback;
    }
    public static function get(string $url, callable $callback): void
    {
        self::addEndpoint('GET', $url, $callback);
    }
    public static function post(string $url, callable $callback): void
    {
        self::addEndpoint('POST', $url, $callback);
    }
    public static function handle404(callable $callback)
    {
        self::$route['404'] = $callback;
    }
}