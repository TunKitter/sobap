<?php declare(strict_types=1);
$A0 = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
if (strlen($A0) == 0) require "routes/index.php";
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
function_exists($A = $_SERVER['REQUEST_METHOD']) && $A();