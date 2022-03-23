<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', [PostController::class, 'index'])->name('post.index');
Route::get('posts/{post}', [PostController::class, 'detail'])->name('post.detail');
Route::post('posts', [PostController::class, 'store'])->name('post.store');
Route::put('posts/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('posts/{post}', [PostController::class, 'delete'])->name('post.delete');
