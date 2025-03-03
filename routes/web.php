<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [ImageController::class, 'index'])->name('home')->middleware('auth');
Route::get('/upload', [ImageController::class, 'create'])->name('upload')->middleware('auth');
Route::post('/upload', [ImageController::class, 'store'])->middleware('auth');

Auth::routes();
