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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/home', [App\Http\Controllers\HomeController::class, 'registrar'])->name('user.registrar');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])
->name('admin');

Route::post('/admin', [App\Http\Controllers\AdminController::class, 'buscar'])
->name('admin');

Route::get('/registrar', [App\Http\Controllers\AdminController::class, 'marcar'])->name('registrar');

Route::post('/registrar', [App\Http\Controllers\AdminController::class, 'registrar'])->name('admin.registrar');