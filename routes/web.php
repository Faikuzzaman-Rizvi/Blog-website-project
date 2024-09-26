<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(['register' => false]);


Route::get('/',[FrontendController::class , 'index']);



//dashboard routes..
Route::get('/home', [HomeController::class, 'index'])->name('home');

//management routes..
Route::get('/management', [ManagementController::class, 'index'])->name('management.index');
Route::post('/management/user/register', [ManagementController::class, 'store_register'])->name('management.store');
Route::post('/management/user/manager/down/{id}', [ManagementController::class, 'manager_down'])->name('management.down');
Route::get('/management/edit/{id}', [ManagementController::class, 'edit'])->name('management.edit');

//profile routes..
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/username/update', [ProfileController::class, 'name_update'])->name('profile.username');
Route::post('/profile/email/update', [ProfileController::class, 'email_update'])->name('profile.email');
Route::post('/profile/password/update', [ProfileController::class, 'password_update'])->name('profile.password');
Route::post('/profile/image/update', [ProfileController::class, 'image_update'])->name('profile.image');


//category

Route::get('/category',[CategoryController::class,'index'])->name('category.index');
Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
Route::get('/category/edit/{slug}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('/category/edit/update{slug}',[CategoryController::class,'update'])->name('category.update');
Route::get('/category/destroy/{slug}',[CategoryController::class,'destroy'])->name('category.destroy');
Route::post('/category/status/{id}',[CategoryController::class,'status'])->name('category.status');
