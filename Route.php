<?php
class Route
{
    private static array $route = ['GET' => [], 'POST' => [], '404' => null];
    private static function checkExist($url, string $type)
    {
        $url = trim(parse_url($url, PHP_URL_PATH), '/');
        $matches = [];
        $data = array_find(self::$route[$type], function ($k, $v) use (&$matches, $url) {
            return preg_match("#^$v$#", $url, $matches);
        });
        array_shift($matches);
        return ['status' => $data ? true : false, 'data' => $data ?? null, 'matches' => $matches];
    }
    public static function dispatch()
    {
        $t = self::checkExist($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
        if ($t['status'])
            $t['data']($t['matches']);
        else
            self::$route['404'] ? (self::$route['404'])() : print "Not found";
    }
    private static function addEndpoint(string $type, string $url, callable $callback)
    {
        $url = trim($url, '/');
        $pattern = preg_replace("/\{[\w\-]+\}/", "([^\/]+)", $url);
        self::$route[$type][$pattern] = $callback;
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