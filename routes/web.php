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
});

Route::get('/index', function() {
    return view('index');
});

Route::get('/account', function() {
    return view('account');
});

Route::get('/perfil', function() {
    return view('perfil');
});

Route::get('/post', function() {
    return view('post');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
