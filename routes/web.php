<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

// post通信のときはRoute::post
Route::get('/', [App\Http\Controllers\HomeController::class, 'myRoom'])->name('index');
Route::get('/myRoom', [App\Http\Controllers\HomeController::class, 'myRoom'])->name('myRoom');
Route::get('/room/{roomId}', [App\Http\Controllers\HomeController::class, 'transitionToRoom'])->name('transitionToRoom');
Route::get('/transitionToMakeRoom', [App\Http\Controllers\HomeController::class, 'transitionToMakeRoom'])->name('transitionToMakeRoom');
Route::post('/transitionToMakeLinkCard', [App\Http\Controllers\HomeController::class, 'transitionToMakeLinkCard'])->name('transitionToMakeLinkCard');
Route::post('/makeRoom', [App\Http\Controllers\HomeController::class, 'makeRoom'])->name('makeRoom');
Route::post('/makeLinkCard', [App\Http\Controllers\HomeController::class, 'makeLinkCard'])->name('makeLinkCard');
