<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('permission/index',[PermissionController::class,'permission_index'])->name('permission.index');
    Route::get('permission/create',[PermissionController::class,'permission_create'])->name('permission.create');
    Route::post('permission/store',[PermissionController::class,'permission_store'])->name('permission.store');
    Route::get('permission/edit/{id}',[PermissionController::class,'permission_edit'])->name('permission.edit');
    Route::post('permission/update/{id}',[PermissionController::class,'permission_update'])->name('permission.update');
    
    
    Route::get('role/index',[RoleController::class,'role_index'])->name('role.index');
    Route::get('role/create',[RoleController::class,'role_create'])->name('role.create');
    Route::post('role/store',[RoleController::class,'role_store'])->name('role.store');
    Route::get('role/edit/{id}',[RoleController::class,'role_edit'])->name('role.edit');
    Route::post('role/update/{id}',[RoleController::class,'role_update'])->name('role.update');


    Route::get('article/index',[ArticleController::class,'article_index'])->name('article.index');
    Route::get('article/create',[ArticleController::class,'article_create'])->name('article.create');
    Route::post('article/store',[ArticleController::class,'article_store'])->name('article.store');
    Route::get('article/edit/{id}',[ArticleController::class,'article_edit'])->name('article.edit');
    Route::post('article/update/{id}',[ArticleController::class,'article_update'])->name('article.update');


    Route::get('user/index',[UserController::class,'user_index'])->name('user.index');
    Route::get('user/edit/{id}',[UserController::class,'user_edit'])->name('user.edit');
    Route::post('user/update/{id}',[UserController::class,'user_update'])->name('user.update');

});

require __DIR__.'/auth.php';
