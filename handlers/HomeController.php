<?php
class HomeController
{
    public static function index(Request $request)
    {
        // Database::transaction(function ($commit, $rollback) {
            // $a = 0;
            // Database::delete('something', 'id = 193');
            // Database::delete('something', 'id = 195');
            // $a == 1 ? $commit() : $rollback();
        // });
        // var_dump($a);
        $view = View::getView('views/home', ['methods/layout', 'methods/home']);
        $view->home->setName("Edited Home");
        $view->layout->render();
    }
}