<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',[LoginController::class, 'index'])->name('login');
Route::post('login',[LoginController::class, 'store'])->name('login.store');

Route::prefix('user')->group(function()  {
    Route::get('',[UserController::class, 'index'])->name('user');
    Route::get('logout',[LogOutController::class, 'logout'])->name('user.logout');
    Route::get('posts',[PostController::class, 'index'])->name('user.posts');
    Route::get('posts/create',[PostController::class, 'create'])->name('user.posts.create');
    Route::post('posts',[PostController::class, 'store'])->name('user.posts.store');
    Route::get('posts/{post}',[PostController::class, 'show'])->name('user.posts.show');
    Route::get('posts/{post}/edit',[PostController::class, 'edit'])->name('user.posts.edit');
    Route::put('posts/{post}',[PostController::class, 'update'])->name('user.posts.update');
    Route::get('posts/{post}/delete',[PostController::class, 'delete'])->name('user.posts.delete');
});

Route::prefix('admin')->group(function() {
    Route::redirect('/','/admin/posts')->name('admin');
    Route::get('posts',[PostController::class, 'index'])->name('admin.posts');
    Route::get('posts/create',[PostController::class, 'create'])->name('admin.posts.create');
    Route::post('posts',[PostController::class, 'store'])->name('admin.posts.store');
    Route::get('posts/{post}',[PostController::class, 'show'])->name('admin.posts.show');
    Route::get('posts/{post}/edit',[PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('posts/{post}',[PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('posts/{post}/delete',[PostController::class, 'delete'])->name('admin.posts.delete');
});