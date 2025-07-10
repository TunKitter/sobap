<?php
class Auth
{
    public static function login(Request $request)
    {
        echo <<<EOF
        <form method="POST">
        <input type="text" name="username">
        <input type="password" name="password">
        <button>Login</button>
        </form>
        EOF;
    }
    public static function handleLogin(Request $request)
    {
        var_dump($request->post('username'));
        var_dump($request->post('password'));
    }

    public static function register(Request $request)
    {
        echo "Register page";
    }
}