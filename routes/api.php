<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\AttendanceController;

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

Route::group(['prefix' => 'auth'], function () {
    // Route::post('/register', 'App\Http\Controllers\Api\Auth\AuthController@register');
    // Route::post('/login', 'App\Http\Controllers\Api\Auth\AuthController@login');
    // Route::post('/logout', 'App\Http\Controllers\Api\Auth\AuthController@logout')->middleware('auth:sanctum');

    // Route::post('/password/reset', 'App\Http\Controllers\Api\Auth\PasswordController@reset')
    // ->middleware('auth:sanctum');
    // Route::post('/password/forgot', 'Api\Auth\PasswordController@sendResetLinkEmail');

    Route::post('register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::post('/password/reset', [AuthController::class, 'reset']);
    Route::post('/password/forgot', [AuthController::class, 'sendResetLinkEmail']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    // Route::post('/attendance', 'App\Http\Controllers\Api\AttendanceController@store');
    // Route::get('/attendance/history', 'App\Http\Controllers\Api\AttendanceController@history');

    Route::post('attendance', [AttendanceController::class, 'store']);
    Route::get('attendance/history', [AttendanceController::class, 'history']);
});
