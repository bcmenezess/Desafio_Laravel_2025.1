<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PagSeguroController;
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
    Route::get('/users-table/delete/{id}',[UserController::class,'deleteView'])->name('delete-user');
    Route::delete('/users-table/delete/{id}',[UserController::class,'delete']);

    Route::get('/admins-table',[AdminController::class,'table'])->name('admins-table');
    Route::get('/admins-table/add',[AdminController::class,'create'])->name('add-admin');
    Route::post('/admins-table/add',[AdminController::class,'store']);
    Route::get('/admins-table/edit/{id}',[AdminController::class,'editView']);
    Route::put('/admins-table/edit/{id}',[AdminController::class,'edit'])->name('edit-admin');
    Route::get('/admins-table/view/{id}',[AdminController::class,'view'])->name('view-admin');
    Route::get('/admins-table/delete/{id}',[AdminController::class,'deleteView'])->name('delete-admin');
    Route::delete('/admins-table/delete/{id}',[AdminController::class,'delete']);

});

Route::prefix('user')->middleware(UserMiddleware::class)->group(function (){
    Route::post('/checkout',[PagSeguroController::class,'createCheckout'])->name('checkout');

    Route::get('/erro-checkout',function(){
        return view('user.erro-checkout');
    })->name('erro-checkout');

    Route::get('/withdraw', [UserController::class,'viewWithdraw'])->name('withdraw');
    Route::put('/withdraw', [UserController::class,'withdraw']);

});


Route::middleware(AuthOrAdminMiddleware::class)->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/landing-page',[ProductController::class,'index'])->name('landing-page');
    Route::get('/item/{id}',[ProductController::class,'visuProdutos'])->name('item-view');

    Route::get('/products-table',[ProductController::class,'table'])->name('products-table');
    Route::get('/products-table/add',[ProductController::class,'create'])->name('add-product');
    Route::post('/products-table/add',[ProductController::class,'store']);
    Route::get('/products-table/edit/{id}',[ProductController::class,'editView']);
    Route::put('/products-table/edit/{id}',[ProductController::class,'edit'])->name('edit-product');
    Route::get('/products-table/delete/{id}',[ProductController::class,'deleteView'])->name('delete-product');
    Route::delete('/products-table/delete/{id}',[ProductController::class,'delete']);
});

require __DIR__.'/auth.php';
