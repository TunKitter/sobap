<?php
require "libs/Controller.php";
r("controllers/");
function r($path)
{
    $c = scandir($path);
    $t = count($c);
    for ($i = 2; $i < $t; $i++) {
        if (is_file($path . $c[$i])) {
            require_once $path . $c[$i];
            $n = str_replace(".php", "", $c[$i]);
            $n::setup();
        } elseif (is_dir($path . $c[$i]))
            r($path . $c[$i] . "/");
    }
}