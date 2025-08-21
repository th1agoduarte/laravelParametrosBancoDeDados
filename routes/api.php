<?php

use App\Http\Controllers\Api\AuthApiController;
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

Route::name('auth.')->prefix('v1')->group(function () {

    Route::post('/auth/register', [AuthApiController::class, 'register'])->name('register');

    Route::post('/auth/login', [AuthApiController::class, 'login'])->name('login');

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/me', [AuthApiController::class, 'me'])->name('me');
        Route::post('/auth/logout', [AuthApiController::class, 'logout'])->name('logout');
    });
});
