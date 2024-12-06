<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/symlink', function () {
    Artisan::call('storage:link');
});
Route::get('/fresh_data', function () {
    Artisan::call('migrate:fresh');
});
Route::get('/migrate_data', function () {
    Artisan::call('migrate');
});
