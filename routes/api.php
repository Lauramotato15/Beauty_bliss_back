<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesDetailsController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login'])->name('login'); 
Route::post('user/register', [UserController::class, 'store'])->name('create'); 

Route::middleware(['auth:api'])->group(function (){
    
    Route::prefix('user')->controller(UserController::class)->group(function(){
        Route::get('/', 'index')->name('allUser');
        Route::post('update/me', 'update')->name('update');
        Route::get('find/{id}', 'show');
        Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('delete'); 
    }); 

    Route::get('sale/id-user', [SalesController::class, 'findIdUser']); 
    Route::get('product/find-by-name/{name}', [ProductController::class, 'findByName']);
    Route::get('product/find-by-category/{category}', [ProductController::class, 'findByName']);
    
    Route::apiResource('category', CategoryController::class); 
    Route::apiResource('product', ProductController::class);
    Route::apiResource('sale', SalesController::class);
    Route::apiResource('saleDetail', SalesDetailsController::class); 
    Route::apiResource('stock', StockController::class);

    Route::get('auth/logout', [AuthController::class, 'logout']);
});

