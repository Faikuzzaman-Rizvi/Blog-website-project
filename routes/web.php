<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/',[FrontendController::class , 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
