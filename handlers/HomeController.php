<?php
class HomeController
{
    public static function index(Request $request)
    {
        $view = View::getView('home', 'home');
        $view->render();
    }
}