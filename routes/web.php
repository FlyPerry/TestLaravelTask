<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

Route::post('/comments', [CommentController::class, 'store'])->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});
