<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegaloController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Route::get('/regalo', [RegaloController::class, 'index'])->middleware('auth')->name('regaloIndex'); */
Route::resource('regalos', RegaloController::class)->middleware('auth');