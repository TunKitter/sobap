<?php
Route::get('/', 'HomeController::index');
Route::get('/login', 'Auth::login');
Route::post('/login', 'Auth::handleLogin');
Route::get('/register', 'Auth::register');
Route::get('/blogs', 'Blog::index');
Route::get('/blogs/{id}', 'Blog::detail');