<?php
declare(strict_types=1);
require "DataController.php";
require "Route.php";
Route::get("/demo", fn() => DataController::callMe());
Route::get("/something", fn() => print "Hello something from get");
Route::post("/something", fn() => print "Hello something but post");
Route::handle404(function () {
    echo "Something went wrong bro";
});
Route::dispatch();
