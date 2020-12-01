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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::get('hello', [\App\Http\Controllers\UserController::class,'indexHelp']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('chart', 'DashboardController@chart');
    Route::get('user', [\App\Http\Controllers\UserController::class,'user']);
    Route::put('users/info', [\App\Http\Controllers\UserController::class,'updateInfo']);
    Route::put('users/password', [\App\Http\Controllers\UserController::class,'updatePassword']);
    Route::post('upload', 'ImageController@upload');
    Route::get('export','OrderController@export');

    Route::apiResource('users', 'UserController');
    Route::apiResource('roles', 'RoleController');
    Route::apiResource('products', 'ProductController');
    Route::apiResource('orders', 'OrderController')->only('index', 'show');
    Route::apiResource('permissions', 'PermissionController')->only('index');
});

