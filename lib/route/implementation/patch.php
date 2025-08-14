<?php
class patch implements RouteHandler
{
    public static function handle($args)
    {

        Route::getInstance()->addEndpoint($args[0], function () {
            return $_SERVER['REQUEST_METHOD'] == 'PATCH';
        }, function (Request $data) use ($args) {
            handle_http_method($args, $data);
        });
    }
}