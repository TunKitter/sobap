<?php
class HomeController
{
    public static function index(Request $request)
    {
        $view = View::getView('views/home', ['methods/layout','methods/home']);
        $view->home->setName("Edited Home");
        $view->layout->render();
    }
}