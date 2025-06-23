<?php
Route::get("/demo", HackingController::_('index'));
Route::get("/something", DemoController::_("index"));
Route::get("/tunkit", HackingController::_('vainoi'));