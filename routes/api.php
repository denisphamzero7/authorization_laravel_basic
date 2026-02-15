<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController ;
use App\Http\Controllers\Api\AuthorController;






Route::get('products',[ProductController::class,'getAllProduct']);

Route::prefix('auth')->name('auth.')->group(function(){
Route::post('/login',[AuthorController::class,'login']);
});
