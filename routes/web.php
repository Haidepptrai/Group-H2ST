<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
//Admin dashboard
Route::get('admin/index',[AdminController::class,'dashboard']);
//Admin categories
Route::get('admin/categories-list',[AdminController::class,'categoriesList']);
Route::get('admin/categories-add',[AdminController::class,'categoriesAdd']);
Route::post('admin/categories-save',[AdminController::class,'categoriesSave']);
Route::get('admin/categories-edit/{id}',[AdminController::class,'categoriesEdit']);
Route::post('admin/categories-update',[AdminController::class,'categoriesUpdate']);
Route::get('admin/categories-delete/{id}',[AdminController::class,'categoriesDelete']);
//Admin products
Route::get('admin/products-list',[AdminController::class,'productsList']);
Route::get('admin/products-add',[AdminController::class,'productsAdd']);
Route::post('admin/products-save',[AdminController::class,'productsSave']);
Route::get('admin/products-edit/{id}',[AdminController::class,'productsEdit']);
Route::post('admin/products-update',[AdminController::class,'productsUpdate']);
Route::get('admin/products-delete/{id}',[AdminController::class,'productsDelete']);
