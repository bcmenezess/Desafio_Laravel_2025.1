<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthOrAdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware(AdminMiddleware::class)->group(function () {
    Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
    Route::get('/users-table',[UserController::class,'index'])->name('users-table');
    Route::get('/users-table/add',[UserController::class,'create'])->name('add-user');
    Route::post('/users-table/add',[UserController::class,'store']);
    Route::get('/users-table/edit/{id}',[UserController::class,'editView']);
    Route::put('/users-table/edit/{id}',[UserController::class,'edit'])->name('edit-user');
    Route::get('/users-table/view/{id}',[UserController::class,'view'])->name('view-user');

});

Route::prefix('user')->middleware(UserMiddleware::class)->group(function (){
});

//Route::post('/landing-page', [ProductController::class, 'index']);

Route::middleware(AuthOrAdminMiddleware::class)->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/landing-page',[ProductController::class,'index'])->name('landing-page');
    Route::get('/item/{id}',[ProductController::class,'visuProdutos'])->name('item-view');
});

require __DIR__.'/auth.php';
