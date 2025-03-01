<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;


Route::name('auth.')->group(base_path('routes/public/auth.php'));

// Public
Route::name('public.')->group(base_path('routes/public/index.php'));
