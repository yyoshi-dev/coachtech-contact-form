<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

// お問い合わせフォーム関連
Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']); // 保存用の処理
Route::get('/thanks', fn() => view('contacts.thanks')); //表示用 (リダイレクト時の処理)

// 管理画面関連
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/search', [AdminController::class, 'search']);
    Route::get('/reset', [AdminController::class, 'reset']);
    Route::delete('/delete', [AdminController::class, 'destroy']);
    Route::get('/export', [AdminController::class, 'export']);
});

// ログイン済みで/loginに来たら/adminへリダイレクト
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/admin');
    }
    return view('auth.login');
})->name('login');

// ログイン済みで/registerに来たら/adminへリダイレクト
Route::get('/register', function () {
    if (Auth::check()) {
        return redirect('/admin');
    }
    return view('auth.register');
})->name('register');
