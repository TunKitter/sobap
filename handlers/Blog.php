<?php
class Blog
{
    public static function index()
    {
        echo "Blog page";
    }
    public static function detail(Request $request)
    {
        echo "Blog detail page of {$request->param('id')}";
    }
}