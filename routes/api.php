<?php

use App\Http\Controllers\PostCategorieController;
use App\Http\Controllers\PostController;
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
//user delete
Route::Post('delete',[userController::class,'delete']);


//get allpost
Route::get('/post/index',[PostController::class,'index']);
//create post
Route::Post('post/store',[PostController::class,'store']);
//show first post
Route::Post('post/show/{post}',[PostController::class,'show']);
//update post
Route::Post('post/update{post}',[PostController::class,'update']);
//destroy post
Route::Post('post/show/{post}',[PostController::class,'destroy']);


//get all categories
Route::get('category/index',[PostCategorieController::class,'index']);
//create category
Route::Post('category/store',[PostCategorieController::class,'store']);
//show first category
Route::Post('category/show/{post_categorie}',[PostCategorieController::class,'show']);
//update category
Route::Post('category/update/{post_categorie}',[PostCategorieController::class,'update']);
//destroy category
Route::Post('category/destroy/{post_categorie}',[PostCategorieController::class,'destroy']);
