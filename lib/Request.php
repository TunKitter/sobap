<?php
class Request
{
    private $params;
    public function setParam(array $params)
    {
        $this->params = (object) $params;
    }
    public function param($name) {
        return $this->params ? ($this->params->{$name} ?? null) : null;
    }
    public function get($name,$default = null)
    {
        return $_GET[$name] ?? $default;
    }
    public function post($name, $default = null)
    {
        return $_POST[$name] ?? $default;
    }
}