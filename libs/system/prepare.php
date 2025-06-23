<?php
require "libs/Controller.php";
$c = scandir("controllers");
for ($i = 2; $i < count($c); $i++) {
    require_once "controllers/" . $c[$i];
    $n = str_replace(".php", "", $c[$i]);
    $n::setup();
}