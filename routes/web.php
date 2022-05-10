<?php

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

Auth::routes();

Route::post('r/{post}', 'App\Http\Controllers\ReactionController@store');
Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('home.show');
Route::get('/m/{user}/messages', [App\Http\Controllers\MessageController::class, 'index'])->name('m.messages.index');
Route::post('/follow/{user}', 'App\Http\Controllers\FollowController@store');
Route::get('/p/create', [App\Http\Controllers\PostController::class, 'create'])->name('p.create');
Route::get('/p/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('p.show');
Route::post('/p', [App\Http\Controllers\PostController::class, 'store'])->name('p.store');
Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.show');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');


