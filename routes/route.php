<?php
Route::get('something/{demo}','Demo::wow');

Route::get("anh/la/ai",function() {
    echo "Just call me";
});
Route::post("/", 'Demo::wow');

