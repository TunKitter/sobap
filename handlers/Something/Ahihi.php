<?php
class Ahihi
{
    public static function something(Request $request)
    {
        var_dump($request->param('demo'));
    }
}