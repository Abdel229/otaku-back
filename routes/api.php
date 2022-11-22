<?php

use App\Http\Controllers\userController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//user registration
Route::Post('register',[userController::class,'register']);
//user Login
Route::Post('login',[userController::class,'login']);
//user Logout
Route::Post('log-out',[userController::class,'logOut']);

