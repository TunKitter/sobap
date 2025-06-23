<?php
Route::get("/", HomeController::_('index'));
Route::post("/", HomeController::_('handle_index'));