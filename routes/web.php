<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostCommentController;

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
Route::get('/{user}', [ProfileController::class, 'index'])->name('profile');
Route::post('/{user}/upload', [PhotoController::class, 'store'])->name('upload.picture');
Route::get('/{user}/profile_pic/new', [ProfileController::class, 'pic'])->name('profile.upload_pic');

// Posts
Route::get('/post/{id}', [PostController::class, 'single'])->name('post.single');
Route::post('/post/new', [PostController::class, 'create'])->name('post.create');
Route::post('/post/remove', [PostController::class, 'destroy'])->name('post.remove');
Route::post('/post/like', [PostController::class, 'like'])->name('post.like');

// Comments
Route::post('/post/comment/new', [PostCommentController::class, 'create'])->name('post.comment.add');
Route::post('/post/comment/remove', [PostCommentController::class, 'destroy'])->name('post.comment.remove');
Route::post('/post/comment/like', [PostCommentController::class, 'like'])->name('post.comment.like');