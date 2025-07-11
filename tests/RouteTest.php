<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\DataProvider;
require_once "lib/route/Route.php";
require_once "lib/route/implementation/get.php";
require_once "lib/route/implementation/post.php";
class RouteTest extends TestCase
{
    public static $instance;
    public static function setUpBeforeClass(): void
    {
        static::$instance = Route::getInstance();
        $data = static::fakeRouteGet();
        $_SERVER['REQUEST_METHOD'] = "GET";
        foreach ($data as $path => $controller) Route::get($path, $controller);

        $data = static::fakeRoutePost();
        $_SERVER['REQUEST_METHOD'] = "POST";
        foreach ($data as $path => $controller) Route::post($path, $controller);
    }
    #[TestDox("Test the same instance every call Route object")]
    public function testInstance()
    {
        $_SERVER['REQUEST_URI'] = "";
        $this->assertSame(static::$instance, Route::getInstance());
        $this->assertSame(Route::getInstance(), Route::getInstance());
    }
    public static function fakeRouteGet()
    {
        return [
            '/' => ['/', 'HomeController::index'],
            '/login' => ['/login', 'Auth::login'],
            '/register' => ['/register', 'Auth::register'],
            '/blogs' => ['/blogs', 'Blog::index'],
            '/blogs/{id}' => ['/blogs/{id}', 'Blog::detail'],
            '/demo' => ['/demo', 'Demo/Like/Something::vai'],
        ];
    }
    public static function fakeRoutePost()
    {
        return [
            '/login-post' => ['/login-post', 'Demo/Like/Something::vai'],
            '/something/{demo}' => ['/something/{demo}', 'Something::demo'],
        ];
    }
    public function handleDataRoute($path, $controller)
    {
        $this->assertNotNull(array_find(static::$instance->route, function ($value) use ($path) {
            $url = trim($path, '/');
            $escapedUrl = preg_quote($url, '#');
            $pattern = preg_replace("/\\\\\{[\w\-]+\\\\\}/", "([^\/]+)", $escapedUrl);
            preg_match_all("/{\w+}/", $url, $params);
            return trim($value[0], "/") == trim($pattern, "/") && count($params[0]) == count($value[1]) && ($value[2])() && is_callable($value[3]);
        }));
    }
    #[TestDox("Test insert route with get method")]
    #[DataProvider('fakeRouteGet')]
    public function testDataGetRoute($path, $controller)
    {
        $_SERVER['REQUEST_METHOD'] = "GET";
        static::handleDataRoute($path, $controller);
    }
    #[TestDox("Test insert route with post method")]
    #[DataProvider('fakeRoutePost')]
    public function testDataPostRoute($path, $controller)
    {
        $_SERVER['REQUEST_METHOD'] = "POST";
        static::handleDataRoute($path, $controller);
    }
}