<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LesController;
use App\Http\Controllers\PasswordController;
use App\Http\Middleware\AdminMiddleware;


Route::get('/', function () {
    return view('login');
});

// Wachtwoord
Route::get('/wachtwoord', [PasswordController::class, 'showPasswordForm'])->name('password.form');
Route::post('/wachtwoord', [PasswordController::class, 'setPassword'])->name('set-password');

Route::group(['middleware' => 'guest'], function () {
    // Login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');

});

Route::group(['middleware' => 'auth'], function () {
    // Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Logout
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => AdminMiddleware::class], function () {
    // Register
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');

    // Add Lesson
    Route::get('/addLes', [LesController::class, 'addLes'])->name('index');
    Route::post('/addLes', [LesController::class, 'addLesPost'])->name('addLes');
});