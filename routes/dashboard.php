<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
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
    Route::resource('/categories', CategoryController::class);

});



