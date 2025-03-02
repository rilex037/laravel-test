<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $initialCount = 42;
    return view('welcome', ['initialCount' => $initialCount]);
});
