<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/signup', [AuthController::class, 'signup'])->name('api.signup');

Route::middleware('auth:sanctum')
    ->prefix('todos')
    ->name('todos.')
    ->group(function () {
        Route::get('/', [TodoController::class, 'get'])->name('get');
        Route::post('/', [TodoController::class, 'create'])->name('create');
        Route::put('/{id}', [TodoController::class, 'update'])->name('update');
        Route::delete('/{id}', [TodoController::class, 'delete'])->name(
            'delete',
        );
    });
