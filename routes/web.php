<?php

use App\Http\Controllers\friendRequestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PDFController;


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
Route::get('/{user}', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/{user}/upload', [PhotoController::class, 'store'])->name('upload.picture')->middleware('auth');
Route::get('/{user}/profile_pic/new', [ProfileController::class, 'pic'])->name('profile.upload_pic')->middleware('auth');

// Posts
Route::get('/post/{id}', [PostController::class, 'single'])->name('post.single')->middleware('auth');
Route::post('/post/new', [PostController::class, 'create'])->name('post.create')->middleware('auth');
Route::post('/post/remove', [PostController::class, 'destroy'])->name('post.remove')->middleware('auth');
Route::post('/post/like', [PostController::class, 'like'])->name('post.like')->middleware('auth');

// Comments
Route::post('/post/comment/new', [PostCommentController::class, 'create'])->name('post.comment.add')->middleware('auth');
Route::post('/post/comment/remove', [PostCommentController::class, 'destroy'])->name('post.comment.remove')->middleware('auth');
Route::post('/post/comment/like', [PostCommentController::class, 'like'])->name('post.comment.like')->middleware('auth');

// Friends
Route::post('/{user}/friend/new', [FriendsController::class, 'create'])->name('friend.add')->middleware('auth');
Route::post('/{user}/friend/remove', [FriendsController::class, 'destroy'])->name('friend.remove')->middleware('auth');

// Search
Route::get('/search/{user_search}', [SearchController::class, 'search'])->name('user.search')->middleware('auth');


Route::get('/send-friendrequest', [friendRequestController::class, 'sendFriendReqNotification']);
// PDF
Route::post('/export', [PDFController::class, 'export'])->name('export')->middleware('auth');
Route::post('/exportPost', [PDFController::class, 'exportPost'])->name('exportPost')->middleware('auth');

