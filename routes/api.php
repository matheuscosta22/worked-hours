<?php

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

Route::group(['middleware' => ['auth:sanctum']], function ($route) {
    Route::post('/day-worked/started-at', [App\Http\Controllers\DayWorkedController::class, 'started_at'])->name('day.worked.started_at');
    Route::post('/day-worked/break', [App\Http\Controllers\DayWorkedController::class, 'break'])->name('day.worked.break');
    Route::apiResource('/user', App\Http\Controllers\UserController::class)->names('user');
    Route::apiResource('/day-worked', App\Http\Controllers\DayWorkedController::class)->names('day.worked');
    Route::post('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');
    Route::post('/me', [App\Http\Controllers\UserController::class, 'me'])->name('me');
});
Route::post('/login', [App\Http\Controllers\UserController::class, 'login'])->name('login');
 