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
Route::get('/room', [App\Http\Controllers\HomeController::class, 'transitionToRoom'])->name('transitionToRoom');

Route::get('/makeRoom', [App\Http\Controllers\HomeController::class, 'transitionToMakeRoom'])->name('transitionToMakeRoom');
Route::post('/makeRoom/done', [App\Http\Controllers\HomeController::class, 'makeRoom'])->name('makeRoom');

Route::post('/makeLinkCard', [App\Http\Controllers\HomeController::class, 'transitionToMakeLinkCard'])->name('transitionToMakeLinkCard');
Route::post('/makeLinkCard/done', [App\Http\Controllers\HomeController::class, 'makeLinkCard'])->name('makeLinkCard');

// Route::get('/transitionTosearchRoom', [App\Http\Controllers\HomeController::class, 'transitionTosearchRoom'])->name('transitionTosearchRoom');
Route::get('/searchRoom', [App\Http\Controllers\HomeController::class, 'searchRoom'])->name('searchRoom');

Route::get('/withdrawal', [App\Http\Controllers\HomeController::class, 'transitionToWithdrawal'])->name('transitionToWithdrawal');
Route::get('/withdrawal/done', [App\Http\Controllers\HomeController::class, 'withdrawal'])->name('withdrawal');

