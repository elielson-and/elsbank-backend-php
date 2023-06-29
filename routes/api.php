<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
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

// Register a new user
Route::post('/user',[UserController::class,'store']);
// Login
Route::post('/user/login',[AuthController::class,'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)->group(function (){
        Route::get('/user/{uuid}','show');
    });
});
