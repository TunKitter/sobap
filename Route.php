<?php
class Route
{
    private static array $route = ['get' => [], 'post' => [], '404' => null];
    private static function checkExist($url, string $type)
    {
        $data = self::$route[$type];
        if (array_key_exists($url, $data))
            return ['status' => true, 'data' => $data[$url]];
        else
            return ['status' => false, 'data' => null];

    }
    public static function dispatch()
    {
        $t = self::checkExist($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
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
        self::addEndpoint('get', $url, $callback);
    }
    public static function post(string $url, callable $callback): void
    {
        self::addEndpoint('post', $url, $callback);
    }
    public static function handle404(callable $callback)
    {
        self::$route['404'] = $callback;
    }
}