<?php

use Illuminate\Support\Facades\Route;


Route::name('auth.')->group(base_path('routes/public/auth.php'));

// Public
Route::name('public.')->group(base_path('routes/public/index.php'));
Route::name('admin.')->group(base_path('routes/admin.php'));
