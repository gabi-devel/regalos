<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegaloController;
use App\Http\Controllers\PerfilController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('regalos', RegaloController::class)->middleware('auth');

Route::get('/perfil/{id}', [PerfilController::class, 'verPerfil'])->name('perfil.ver');