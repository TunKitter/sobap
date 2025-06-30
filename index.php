<?php declare(strict_types=1);
function A($method, $name)
{
    $A0 = $_SERVER['REQUEST_METHOD'];
    if (in_array($A0, $method)) require "handler/$name/$A0.php";
    else exit();
}
$A = $_SERVER['REQUEST_URI'];
if(!preg_match("/^[0-9a-zA-Z\/]+$/",$A)) {
    require "routes/notfound.php";
    exit();
}
$A0 = trim(parse_url($A, PHP_URL_PATH), "/");
if ($A0 == "") require "routes/index.php";
elseif(is_dir("routes/$A0")) require "routes/notfound.php";
elseif (is_file("routes/$A0.php")) require "routes/$A0.php";
else {
    $A1 = explode("/", $A0);
    $A2 = "routes";
    array_map(function ($e) use (&$A2) {
        $A2 .= '/{' . $e . ',_}';
    }, $A1);
    $A2 .= ".php";
    require glob($A2, \GLOB_BRACE)[0] ?? "routes/notfound.php";
}