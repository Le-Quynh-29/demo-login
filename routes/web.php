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

Route::post('',[\App\Http\Controllers\AuthController::class,'checkLogin'])->name('login');
Route::get('logout',[\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'backend', 'middleware' => ['auth']], function(){
    Route::get('show-success', [\App\Http\Controllers\AuthController::class, 'showSuccess'])->name('login_success');

});
Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'backend']], function(){
    Route::get('admin', [\App\Http\Controllers\GroupController::class, 'index'])->name('backend');
});
Route::group(['prefix' => 'frontend', 'middleware' => ['auth', 'frontend']], function(){
    Route::get('', [\App\Http\Controllers\GroupController::class, 'create'])->name('frontend');
});


