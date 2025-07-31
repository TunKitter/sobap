<?php
require_once getenv("ROOT_DIR"). "/lib/auth/AuthMethod.php";
class Auth
{
    public static function use(string $method): AuthMethod
    {
        if (!function_exists("auth_$method")) require_once getenv("ROOT_DIR") . "/lib/auth/methods/$method.php";
        $method = "auth_$method";
        return $method();
    }
}