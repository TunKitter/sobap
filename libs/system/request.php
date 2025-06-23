<?php
trait Request
{
    public static function getRequestData()
    {
        $server = $_SERVER;
        return [
            'method' => $server['REQUEST_METHOD'],
            'uri' => $server['REQUEST_URI'],
            'time' => $server['REQUEST_TIME'],
            'get' => $_GET,
            'post' => $_POST
        ];
    }
}