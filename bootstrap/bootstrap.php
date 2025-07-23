<?php
require "lib/utility/utility.php";
set_error_handler("handleExceptionWithDebug");
set_exception_handler("handleExceptionWithDebug");
require "env.php";
require "views.php";
require "lib/validate/Validate.php";
require "lib/Database/Database.php";

$implementation = scandir("lib/route/implementation");
for($i = 2; $i < count($implementation); $i++) {
    $path = "lib/route/implementation/" . $implementation[$i];
    if(is_file($path)) require $path;
}
require "lib/route/Route.php";
require "lib/Response.php";
require "routes/route.php";
