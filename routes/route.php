<?php
Route::get('something/{demo}','Something/Ahihi::something');

Route::get("anh/la/ai",function(Request $request) {
    var_dump($request->get('demo'));
});
Route::post("/", 'Demo::wow');

