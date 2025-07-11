<?php
class Auth
{
    public static function login(Request $request)
    {
        View::getView('views/auth/login', ['methods/layout','methods/auth/login'])->layout->render();
    }
    public static function handleLogin(Request $request)
    {
        $view = View::getView('views/auth/login', ['methods/layout','methods/auth/login']);
        $view->login->setName("Your user name is : " . $request->post('username'). " and your password is : " . $request->post('password'));
        $view->layout->render();
    }

    public static function register(Request $request)
    {
        echo "Register page";
    }
}