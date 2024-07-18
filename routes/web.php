<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\akadControllerSiam;
use App\Http\Controllers\LoginController;

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


Route::resource('/krs', App\Http\Controllers\akadControllerSiam::class);
Route::resource('/posts', App\Http\Controllers\PostController::class);

//call api
//Route::get('/view/detail/users', [HomeController::class, 'index'])->name('view/detail/users');

//login api
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/loginApi', [LoginController::class, 'loginApi'])->name('loginApi');
