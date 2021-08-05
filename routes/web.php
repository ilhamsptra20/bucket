<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::view('/', 'welcome');
Route::middleware('auth')->group(function(){
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts/store', [PostController::class, 'store'])->name('posts.store');
    
    Route::get('posts/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::patch('posts/update', [PostController::class, 'update'])->name('posts.update');
    
    Route::delete('posts/{post:slug}/delete', [PostController::class, 'destroy'])->name('posts.delete');
});
    
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('categories/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('tags/{tag:slug}', [TagController::class, 'show'])->name('tag.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
