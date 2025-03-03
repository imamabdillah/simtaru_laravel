<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login/auth', [AuthController::class, 'authenticate'])->name('login.auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
