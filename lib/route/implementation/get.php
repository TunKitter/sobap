<?php
class get implements RouteHandler
{
    public static function handle($args)
    {
        Route::getInstance()->addEndpoint($args[0], function () {
            return $_SERVER['REQUEST_METHOD'] == 'GET';
        }, function ($data) use ($args) {
            for($i = 1; $i < count($args); $i++) $args[$i]($data);
        });
    }
}