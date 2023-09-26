<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GroepController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\VraagController;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\StudentMiddleware;


Route::get('/', function () {
    return view('login');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
    Route::get('/wachtwoord', [PasswordController::class, 'showPasswordForm'])->name('password.form');
    Route::post('/wachtwoord', [PasswordController::class, 'setPassword'])->name('set-password');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => AdminMiddleware::class], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/addLes', [LesController::class, 'addLes'])->name('index');
    Route::post('/addLes', [LesController::class, 'addLesPost'])->name('addLes');
    Route::get('/addGroup', [GroepController::class, 'create'])->name('createGroup');
    Route::post('/addGroup', [GroepController::class, 'store'])->name('storeGroup');
    Route::post('/VerwijderVraag/{id}', [VraagController::class, 'VerwijderVraag'])->name('VerwijderVraag');
    Route::post('/archiveerGroep/{id}', [GroepController::class, 'ArchiveerGroep'])->name('archiveerGroep');
    Route::delete('/questions/{question}', [VraagController::class, 'delete'])->name('deleteQuestion');
});

Route::group(['middleware' => StudentMiddleware::class], function () {
    Route::post('/aanmelden/{id}', [LesController::class, 'Aanmelden'])->name('aanmelden');
    Route::post('/stelVraag', [VraagController::class, 'StelVraag'])->name('stelVraag');
    Route::post('/aanwezig', [GroepController::class, 'Aanwezig'])->name('aanwezig');
});