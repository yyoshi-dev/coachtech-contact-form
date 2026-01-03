<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/search', [AdminController::class, 'search']);
    Route::get('/reset', [AdminController::class, 'reset']);
    Route::delete('/delete', [AdminController::class, 'destroy']);
    Route::get('/export', [AdminController::class, 'export']);
});

// ログイン済みで/loginに来たら/adminへ
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/admin');
    }
    return view('auth.login');
})->name('login');
// ログイン済みで/registerに来たら/adminへ
Route::get('/register', function () {
    if (Auth::check()) {
        return redirect('/admin');
    }
    return view('auth.register');
})->name('register');
