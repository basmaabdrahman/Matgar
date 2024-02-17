<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth','verified'],
    'as'=>'dashboard.',
    'prefix'=>'dashboard',
    //'namespace'=>'App\Http\Controllers\Dashboard'
    ],
    function (){
    Route::get('/home', [DashboardController::class,'index']
    )->middleware(['auth', 'verified'])
        ->name('dashboard');
    Route::get('categories/trash',[CategoryController::class,'trash'])->name('categories.trash');
    Route::put('categories/{category}/restore',[CategoryController::class,'restore'])->name('categories.restore');
    Route::delete('categories/{category}/force-delete',[CategoryController::class,'forceDelete'])->name('categories.forceDelete');
    Route::resource('/categories', CategoryController::class);
    Route::get('products/trash',[ProductController::class,'trash'])->name('products.trash');
    Route::put('products/{product}/restore',[ProductController::class,'restore'])->name('products.restore');
    Route::delete('products/{product}/forceDelete',[ProductController::class,'forceDelete'])->name('products.forceDelete');
    Route::resource('/products',ProductController::class);
    Route::resource('/orders',OrderController::class);


    });



