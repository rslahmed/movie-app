<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\MovieController::class, 'index'])->name('Home');
Route::get('movie/view/{id}', [\App\Http\Controllers\MovieController::class, 'view'])->name('Movie.view');
Route::get('movie-all/{type}/{page}', [\App\Http\Controllers\MovieController::class, 'getAll'])->name('Movie.all');
Route::get('search/multi/{query}', [\App\Http\Controllers\MovieController::class, 'search'])->name('Movie.search');
