<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/todos', [App\Http\Controllers\TodoController::class, 'index'])->name('todos.index');
Route::get('/todos/create', [App\Http\Controllers\TodoController::class, 'create'])->name('todos.create');
Route::post('/todos/store', [App\Http\Controllers\TodoController::class, 'store'])->name('todos.store');
Route::get('/todos/edit/{id}', [App\Http\Controllers\TodoController::class, 'edit'])->name('todos.edit');
Route::put('/todos/edit/{id}', [App\Http\Controllers\TodoController::class, 'update'])->name('todos.update');
Route::delete('/todos/delete/{id}', [App\Http\Controllers\TodoController::class, 'delete'])->name('todos.delete');
