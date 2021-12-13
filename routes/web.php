<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotoController;

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
<<<<<<< HEAD
})->middleware('guest');
=======
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/account', function () {
    return view('account');
});
>>>>>>> 41ea1fa99061395611d600ca04a455bd9241815d

Route::get('/perfil', function () {
    return view('perfil');
})->middleware('auth','verified');

Route::get('/post', function () {
    return view('post');
})->middleware('auth');

<<<<<<< HEAD
Auth::routes(['verified' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('admin/home',[HomeController::class,'adminHome'])->name('admin.home')->middleware('is_admin');
=======
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::post('save', [PhotoController::class, 'store'])->name('upload.picture');
>>>>>>> 41ea1fa99061395611d600ca04a455bd9241815d
