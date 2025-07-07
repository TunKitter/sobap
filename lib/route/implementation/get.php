<?php
class get implements RouteHandler
{
    public static function handle($args)
    {
        Route::getInstance()->addEndpoint($args[0], function () {
            return $_SERVER['REQUEST_METHOD'] == 'GET';
        }, function ($data) {
            var_dump(getenv('MODE'));
            var_dump(getenv('SOME'));
            // print_r($data);
        });
    }
}