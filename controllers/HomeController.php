<?php
class HomeController extends Controller
{
    protected static HomeController $instance;
    public function index($request)
    {
        echo <<<EOT
        <form action="/" method="post">
            <input type="text" name="username">
            <input type="password" name="password">
            <input type="submit">
        </form>
        EOT;
    }
    public function handle_index($request)
    {
        echo $request['post']['username'], PHP_EOL, $request['post']['password'];
    }
}