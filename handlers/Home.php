<?php
class Home
{
    public static function index(Request $request)
    {
        // G::getView('header')->render();
        static::template('home',null);
        // G::getView('header','header')->render();
        // $a->setName("Home edited neee");
        // $a->setName2($request->get('demo','hmmmm'));
    }
    public static function template($view,$handler)
    {
        G::getView('header','header')->render();
        G::getView($view,$handler)->render();
        G::getView('footer')->render();
    }
}