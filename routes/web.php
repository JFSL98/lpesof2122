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

Route::get('/post', function () {
    return view('post');
})->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');



// Profile
Route::get('/{user}',[ProfileController::class,'index'])->name('profile');
Route::post('/{user}/upload', [PhotoController::class, 'store'])->name('upload.picture');
Route::get('/{user}/new_profile_pic',[ProfileController::class,'pic'])->name('profile.upload_pic');

// Posts
Route::get('/post/{id}',[PostController::class,'single'])->name('post.single');
Route::post('/post/new', [PostController::class, 'create'])->name('post.create');
Route::post('/post/remove/{id}', [PostController::class, 'destroy'])->name('post.remove');