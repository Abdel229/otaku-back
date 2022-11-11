<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Register
Route::post('/register',[usercontroller::class,'register']);

// Login
Route::post('/Login',[usercontroller::class,'login']);

// Log-out
Route::post('/log-out',[usercontroller::class,'logOut']);
