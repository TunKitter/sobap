<?php
Route::get('/', 'HomeController::index');
Route::get('/login', 'AuthHandler::login');
Route::post('/login', 'AuthHandler::handleLogin');
Route::get('/register', 'AuthHandler::register');
Route::get('/blogs', 'Blog::index');
Route::get('/blogs/{id}', 'Blog::detail');
Route::get('/demo', 'Demo/Like/Something::vai');