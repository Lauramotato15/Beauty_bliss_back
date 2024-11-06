<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesDetailsController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::apiResource('user', UserController::class);
Route::apiResource('stock', StockController::class);
Route::apiResource('product', ProductController::class);
Route::apiResource('category', CategoryController::class); 
Route::apiResource('sale', SalesController::class);
Route::apiResource('saleDetail', SalesDetailsController::class); 

