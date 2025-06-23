<?php

spl_autoload_register(function ($class) {
    $p = '';
    if (str_contains($class, 'Controller'))
        $p = 'controllers/';
    $file = $p . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($file))
        require_once $file;
});
?>