<?php
class HomeController
{
    public static function index(Request $request)
    {
        // $a = Database::delete('something', 'id = 135');
        // var_dump($a);
        $view = View::getView('views/home', ['methods/layout', 'methods/home']);
        $view->home->setName("Edited Home");
        $view->layout->render();
    }
}