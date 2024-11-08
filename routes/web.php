<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('movies');
});

Route::get('/booking', function () {
    return view('booking');
});

Route::get('/confirmation', function () {
    return view('confirmation');
});

Route::get('/return', function () {
    return view('return');
});
