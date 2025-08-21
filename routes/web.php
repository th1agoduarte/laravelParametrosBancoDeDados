<?php

use App\Http\Controllers\App\Dashboard\DashboardController;
use App\Http\Controllers\App\Navigations\NavigationsController;
use App\Http\Controllers\App\Parameters\ParametersController;
use App\Http\Controllers\App\Profile\ProfileController;
use App\Http\Controllers\App\Users\UsersController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('app.dashboard');
})->name('home');
Route::middleware('guest')
    ->get('/login', [HomeController::class, 'login'])->name('login');
/* Routes App */
Route::name('app.')
    ->prefix('app/')
    ->middleware('auth')
    ->group(
        function () {
            Route::middleware('personalmiddleware')->group(
                function () {

                    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
                    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
                    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

                    //Route::get('/{process}/data-excel', [ProcessInconsistenciesApiController::class, 'getDataExcel'])->name('data-excel');

                    Route::name('parameters.')
                        ->prefix('parameters/')
                        ->group(
                            function () {
                                Route::get('/', [ParametersController::class, 'index'])->name('index');
                                Route::post('/update', [ParametersController::class, 'update'])->name('update');
                                Route::post('/delete', [ParametersController::class, 'delete'])->name('delete');
                                Route::post('/store', [ParametersController::class, 'store'])->name('store');
                            }
                        );
                    Route::name('navigations.')
                        ->prefix('navigations/')
                        ->group(
                            function () {
                                Route::get('/', [NavigationsController::class, 'index'])->name('index');
                                Route::post('/update', [NavigationsController::class, 'update'])->name('update');
                                Route::post('/delete', [NavigationsController::class, 'delete'])->name('delete');
                                Route::post('/store', [NavigationsController::class, 'store'])->name('store');
                                Route::post('/itemmenu-delete', [NavigationsController::class, 'itemmenu_delete'])->name('itemmenu.delete');
                                Route::post('/itemmenu-store', [NavigationsController::class, 'itemmenu_store'])->name('itemmenu.store');
                                Route::post('/itemmenu-update', [NavigationsController::class, 'itemmenu_update'])->name('itemmenu.update');
                                Route::post('/subitem-delete', [NavigationsController::class, 'subitem_delete'])->name('subitem.delete');
                                Route::post('/subitem-store', [NavigationsController::class, 'subitem_store'])->name('subitem.store');
                                Route::post('/subitem-update', [NavigationsController::class, 'subitem_update'])->name('subitem.update');
                            }
                        );

                    Route::name('users.')
                        ->prefix('users/')
                        ->group(
                            function () {
                                Route::get('/', [UsersController::class, 'index'])->name('index');
                                Route::post('/update', [UsersController::class, 'update'])->name('update');
                                Route::post('/delete', [UsersController::class, 'delete'])->name('delete');
                                Route::post('/store', [UsersController::class, 'store'])->name('store');
                            }
                        );

                }
            );
        }
    );

Route::get('/logout', [DashboardController::class, 'index'])->name('logout');
Route::get('/profile', [DashboardController::class, 'index'])->name('profile');
require __DIR__ . '/auth.php';
