<?php
class Home
{
    public static function index(Request $request)
    {
        $view = View::getView(['header','footer'],['header','header2']);
        $view->header2->setupMe();
        $view->base->render();
    }
}