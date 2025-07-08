<?php
Route::get("something/{demo}",function($data) {
    var_dump($data);
});

Route::get("something",function($data) {
echo "hii";
});

