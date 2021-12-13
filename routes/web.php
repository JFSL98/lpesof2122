<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

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
    return view('account');
})->middleware('guest');

Route::get('/perfil', function() {
    return view('perfil');
})->middleware('auth','verified');

Route::get('/post', function() {
    return view('post');
})->middleware('auth');

Auth::routes(['verified' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('admin/home',[HomeController::class,'adminHome'])->name('admin.home')->middleware('is_admin');