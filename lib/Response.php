<?php
class Response
{
    public static function json($data)
    {
        header('Content-Type: application/json');
        $json = json_encode($data);
        if ($json === false) {
            http_response_code(500);
            echo json_encode(['error' => 'JSON encoding failed']);
        } else echo $json;
        exit;
    }
    public static function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}