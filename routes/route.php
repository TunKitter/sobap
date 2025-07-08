<?php
Route::get("something/{demo}", function ($data) {
    var_dump($data);
}, function () {
    echo "ahihi";
});

Route::post("/", function ($data) {
    echo getenv('MODE');
}, function () {
    echo "ahihi nee";
});

