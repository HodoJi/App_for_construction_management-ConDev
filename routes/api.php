<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


// USER MANAGEMENT (AUTHORIZATION)
Route::post('login',                    [App\Http\Controllers\API\LoginController::class,       'loginUser']);
Route::post('logout',                   [App\Http\Controllers\API\LogoutController::class,      'logout'])->middleware('auth:sanctum');
Route::delete('user-removal/{id}',      [App\Http\Controllers\API\UsersController::class,       'removeUser']);
Route::post('createUser',               [App\Http\Controllers\API\RegisterController::class,    'registerUser']);
Route::post('showExistingUsers',        [App\Http\Controllers\API\UsersController::class,       'getUsersList']);

// CONSTRUCTIONS
Route::post('constructions-list', [App\Http\Controllers\API\ConstructionsController::class, 'getList']);
Route::get('construction-material-show/{id}', [App\Http\Controllers\API\MaterialController::class, 'getMaterialOnConstruction']);
Route::get('getConstructionDetail/{id}', [App\Http\Controllers\API\ConstructionsController::class, 'getConstructionDetailsPage']);
Route::get('getConstructionCount', [App\Http\Controllers\API\ConstructionsController::class, 'getConstructionCount']);
Route::put('addConstruction', [App\Http\Controllers\API\ConstructionsController::class, 'addNewConstruction']);

// USER/EMPLOYEE MANAGMENT
Route::get('construction-workers-show/{id}', [App\Http\Controllers\API\UsersController::class, 'getWorkersOnConstruction']);
Route::get('construction-drivers-show', [App\Http\Controllers\API\UsersController::class, 'getDrivers']);
Route::post('construction-find-employees', [App\Http\Controllers\API\UsersController::class, 'findUsersForConstruction']);
Route::put('construction-assign-employee', [App\Http\Controllers\API\UsersController::class, 'assignUserToConstruction']);
