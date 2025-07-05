<?php
declare(strict_types=1);
require "DataController.php";
require "Route.php";
// Route::get("/demo", fn() => DataController::callMe());
Route::get("/something/{post}", fn($data) => print_r($data));
Route::get("/something/{post}/detail/{detail}", fn($data) => print_r($data));
// Route::post("/something", fn() => print "Hello something but post");
Route::handle404(function () {
    echo "Something went wrong bro";
});
Route::dispatch();
