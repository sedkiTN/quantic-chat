<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SujetController;
use App\Http\Controllers\MessageController;

Route::redirect('/', '/sujets');

Route::get('/sujets', [SujetController::class, 'index'])->name('sujets.index');
Route::get('sujets/{id}', [SujetController::class, 'show'])->where('id', '[0-9]+')->name('sujets.show');
Route::get('sujets/create', [SujetController::class, 'create'])->name('sujets.create');
Route::post('/sujets', [SujetController::class, 'store']);

Route::post('/user', [UserController::class, 'store']);
Route::post('/message', [MessageController::class, 'store']);
