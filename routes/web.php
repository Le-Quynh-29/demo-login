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

Route::get('', function () {
    return view('welcome');
})->name('show_login');
//Route::get('/login-success', function () {
//    return view('success');
//})->name('login_success');

Route::post('',[\App\Http\Controllers\AuthController::class,'checkLogin'])->name('login');
Route::get('logout',[\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('show-ip', [\App\Http\Controllers\AuthController::class, 'index'])->name('ip_address');
Route::get('show-success', [\App\Http\Controllers\AuthController::class, 'showSuccess'])->name('login_success');

Route::get('admin', [\App\Http\Controllers\GroupController::class, 'index'])->name('admin');
Route::get('group/{id}', [\App\Http\Controllers\GroupController::class, 'create'])->name('group');
