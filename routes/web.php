<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\auth\AuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('login', [AuthController::class, 'viewlogin'])->name('login');
Route::get('register', [AuthController::class, 'viewRegister'])->name('register');
Route::post('auth.login', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth.register', [AuthController::class, 'register'])->name('auth.register');

Route::middleware('auth')->group(function () {
    Route::resource('usuarios', UserController::class);
    Route::get('usuarios.export', [UserController::class, 'export'])->name('usuarios.export');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});