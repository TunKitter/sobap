<?php
class HomeController
{
    public static function index(Request $request)
    {
        // $a = Database::insert('something', ['name' => 'vai', 'age' => 42]);
        // var_dump($a);
        $view = View::getView('views/home', ['methods/layout', 'methods/home']);
        $view->home->setName("Edited Home");
        $view->layout->render();
    }
}