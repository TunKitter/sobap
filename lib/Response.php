<?php
class Response
{
    public static function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    public static function redirect($url)
    {
        header("Location: $url");
    }
}