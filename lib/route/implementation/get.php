<?php
require "lib/route/implementation/common/http_method.php";
require "lib/route/abstraction/RouteHandler.php";
class get implements RouteHandler
{
    public static function handle($args)
    {
        Route::getInstance()->addEndpoint($args[0], function () {
            return $_SERVER['REQUEST_METHOD'] == 'GET';
        }, function (Request $data) use ($args) {
            handle_http_method($args, $data);
        });
    }
}