<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//////////////================one to one======================
Route::get('/show-profile',[ProfileController::class,'index']);
//////////////================one to one======================



//////////////================one to many======================
Route::get('/show-category',[CategoryController::class,'index']);

Route::get('/show-attribute',[AttributeController::class,'index']);

Route::get('/show-ingredient',[IngredientController::class,'index']);

Route::get('/show-product',[ProductController::class,'index']);
//////////////================one to many======================



//////////////================many to many======================
Route::get('/show-role-user',[RoleController::class,'index']);
//////////////================many to many======================


//////////////================product (transform and map ) most ======================
Route::get('/show',[ProductController::class,'show']);
Route::get('/showpro/{id}',[ProductController::class,'showpro']);
Route::get('/show-product/top10',[ProductController::class,'top10']);
//////////////================product (transform and map ) most ======================



//////////////================Cart===================================
Route::get('/addcart/{id}',[CartController::class,'addcart']);
Route::get('/show_cart',[CartController::class,'index']);
//////////////================Cart===================================



//////////////================discount Coupon===================================
Route::get('add/coupon',[CouponController::class,'create_coupon']);
Route::post('add/coupon',[CouponController::class,'submit_coupon'])->name('submit_coupon');
//////////////================discount Coupon===================================



