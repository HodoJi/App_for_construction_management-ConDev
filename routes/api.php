<?php

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

// Middlewares:
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// USER MANAGEMENT
Route::post('register',                 [App\Http\Controllers\API\RegisterController::class,    'register']);
Route::post('login',                    [App\Http\Controllers\API\LoginController::class,       'loginUser']);
Route::post('logout',                   [App\Http\Controllers\API\LogoutController::class,      'logout'])->middleware('auth:sanctum');
Route::delete('user-removal/{id}',      [App\Http\Controllers\API\UsersController::class,       'removeUser']);

//
