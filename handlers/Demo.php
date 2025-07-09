<?php
class Demo
{
    public static function wow(Request $request)
    {
        var_dump($request->get('demosdas','nooo'));
    }
}