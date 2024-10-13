<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\CategoryBlogController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(['register' => false]);


Route::get('/',[FrontendController::class , 'index']);
Route::get('/category/{slug}',[CategoryBlogController::class , 'show'])->name('front.categroy.blog');



//dashboard routes..
Route::get('/home', [HomeController::class, 'index'])->name('home');

//management routes..

Route::prefix(env('HOST_NAME'))->middleware(['rolecheck'])->group(function(){

    Route::get('/management', [ManagementController::class, 'index'])->name('management.index');
    Route::post('/management/user/register', [ManagementController::class, 'store_register'])->name('management.store');
    Route::post('/management/user/manager/down/{id}', [ManagementController::class, 'manager_down'])->name('management.down');
    Route::get('/management/edit/{id}', [ManagementController::class, 'edit'])->name('management.edit');
    Route::put('/management/edit/update/{id}', [ManagementController::class, 'update'])->name('management.update');
    Route::get('/management/delete/{id}', [ManagementController::class, 'destroy'])->name('management.delete');

    //role
    Route::get('/management/role', [ManagementController::class, 'role_index'])->name('management.role.index');
    Route::post('/management/role/assign', [ManagementController::class, 'role_assign'])->name('management.role.assign');
    Route::post('/management/role/undo/blogger/{id}', [ManagementController::class, 'blogger_grade_down'])->name('management.role.blogger.down');
    Route::post('/management/role/undo/user/{id}', [ManagementController::class, 'user_grade_down'])->name('management.role.user.down');
    Route::get('/management/role/delete/{id}', [ManagementController::class, 'role_destroy'])->name('management.role.delete');
    Route::get('/management/role/blogger/delete/{id}', [ManagementController::class, 'role_blogger_destroy'])->name('management.role.blogger.delete');



    //block user list
    Route::get('/management/block', [ManagementController::class, 'block_index'])->name('management.block.index');
    Route::post('/management/block/unblock{id}', [ManagementController::class, 'unblock_index'])->name('management.unblock.index');

});





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


//blog

Route::resource('/blog',BlogController::class);
