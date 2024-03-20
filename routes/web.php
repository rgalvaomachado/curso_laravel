<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/create', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');  //precisa ser depois de todas sem parametros dinamicos "id"
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}/edit', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete');
Route::get('/users/{id}/comments', [CommentController::class, 'index'])->name('users.comments.index');
Route::get('/users/{id}/comments/create', [CommentController::class, 'create'])->name('users.comments.create');
Route::post('/users/{id}/comments/create', [CommentController::class, 'store'])->name('users.comments.store');
Route::get('/users/{idUser}/comments/{id}/edit', [CommentController::class, 'edit'])->name('users.comments.edit');
Route::put('/users/{idUser}/comments/{id}/edit', [CommentController::class, 'update'])->name('users.comments.update');

Route::get('/', function () {
    return view('welcome');
});
