<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('user', 'fireauth');
Route::get('/email/verify', [App\Http\Controllers\Auth\ResetController::class, 'verify_email'])->name('verify')->middleware('fireauth');
Route::post('/email/verify', [App\Http\Controllers\Auth\ResetController::class, 'verify'])->name('send.email')->middleware('fireauth');
Route::post('login/{provider}/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleCallback']);

Route::resource('/password/reset', App\Http\Controllers\Auth\ResetController::class);

// if user registered but not verified
Route::middleware('fireauth')->group(function () {
});

// if user registered is verified
Route::middleware(['user', 'fireauth'])->group(function () {
});

// if user role is admin and is verified
Route::middleware(['user', 'fireauth', 'admin'])->group(function () {
});

// if user role is instructur and is verified
Route::middleware(['user', 'fireauth', 'instructur'])->group(function () {
    Route::resource('/home/profile', App\Http\Controllers\Auth\ProfileController::class);
});

// if user role is instructor and is verified
Route::middleware(['user', 'fireauth', 'student'])->group(function () {
});


Route::middleware(['user', 'fireauth', 'auth'])->group(function () {
    Route::get('instruktur/formulir', function () {
        return "Dadang";
    })->name('form.instructur');
});
