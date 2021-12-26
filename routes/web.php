<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('account');
})->middleware('guest');

//Route::get('/perfil', [ProfileController::class, 'index'])->name('perfil');

Route::get('/post', function () {
    return view('post');
})->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::post('save', [PhotoController::class, 'store'])->name('upload.picture');

// Profile
Route::get('/{user}',[ProfileController::class,'index']);

// Posts
Route::post('/post/new', [PostController::class, 'create'])->name('post.create');
Route::post('/post/remove/{id}', [PostController::class, 'destroy'])->name('post.remove');