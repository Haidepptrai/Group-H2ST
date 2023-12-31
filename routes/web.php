<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use Laravel\Socialite\Facades\Socialite;

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
Route::get('admin/index', [AdminController::class, 'dashboard'])->name('adminHome')->middleware('isLoggedIn');
Route::get('admin/login', [AdminController::class, 'login'])->name('adminLogin');
Route::post('admin/loginProcess', [AdminController::class, 'loginProcess'])->name('adminLoginProcess');
Route::get('admin/logout', [AdminController::class, 'logout'])->name('adminLogout');
Route::get('admin/admins-profile', [AdminController::class, 'adminProfile'])->middleware('isLoggedIn');
Route::post('admin/admins-saveProfile', [AdminController::class, 'adminSaveProfile'])->middleware('isLoggedIn');

//Admin categories
Route::get('admin/categories-list', [AdminController::class, 'categoriesList'])->middleware('isLoggedIn');
Route::get('admin/categories-add', [AdminController::class, 'categoriesAdd'])->middleware('isLoggedIn');
Route::post('admin/categories-save', [AdminController::class, 'categoriesSave'])->middleware('isLoggedIn');
Route::get('admin/categories-edit/{id}', [AdminController::class, 'categoriesEdit'])->middleware('isLoggedIn');
Route::post('admin/categories-update', [AdminController::class, 'categoriesUpdate'])->middleware('isLoggedIn');
Route::get('admin/categories-delete/{id}', [AdminController::class, 'categoriesDelete'])->middleware('isLoggedIn');

//admin suppliers
Route::get('admin/suppliers-list', [AdminController::class, 'suppliersList'])->middleware('isLoggedIn');
Route::get('admin/suppliers-add', [AdminController::class, 'suppliersAdd'])->middleware('isLoggedIn');
Route::post('admin/suppliers-save', [AdminController::class, 'suppliersSave'])->middleware('isLoggedIn');
Route::get('admin/suppliers-edit/{id}', [AdminController::class, 'suppliersEdit'])->middleware('isLoggedIn');
Route::post('admin/suppliers-update', [AdminController::class, 'suppliersUpdate'])->middleware('isLoggedIn');
Route::get('admin/suppliers-delete/{id}', [AdminController::class, 'suppliersDelete'])->middleware('isLoggedIn');

//Active Category
Route::get('/unactive_category/{id}', [AdminController::class, 'unactive_category']);
Route::get('/active_category/{id}', [AdminController::class, 'active_category']);

//Admin products
Route::get('admin/products-list', [AdminController::class, 'productsList'])->middleware('isLoggedIn');
Route::get('admin/products-add', [AdminController::class, 'productsAdd'])->middleware('isLoggedIn');
Route::post('admin/products-save', [AdminController::class, 'productsSave'])->middleware('isLoggedIn');
Route::get('admin/products-edit/{id}', [AdminController::class, 'productsEdit'])->middleware('isLoggedIn');
Route::post('admin/products-update', [AdminController::class, 'productsUpdate'])->middleware('isLoggedIn');
Route::get('admin/products-delete/{id}', [AdminController::class, 'productsDelete'])->middleware('isLoggedIn');
Route::get('admin/products-detail/{id}', [AdminController::class, 'productsDetail'])->middleware('isLoggedIn');

//Active Products
Route::get('/unactive_product/{id}', [AdminController::class, 'unactive_product']);
Route::get('/active_product/{id}', [AdminController::class, 'active_product']);

//Products best sellers
Route::get('/normal_product/{id}', [AdminController::class, 'normal_product']);
Route::get('/best_product/{id}', [AdminController::class, 'best_product']);

// Update status for order
Route::get('/confirm_order/{id}', [AdminController::class, 'confirm_order']);
Route::get('/delivery_order/{id}', [AdminController::class, 'delivery_order']);
Route::get('/received_order/{id}', [AdminController::class, 'received_order']);
Route::get('/cancel_order/{id}', [AdminController::class, 'cancel_order']);

// User
Route::get('admin/users-list', [AdminController::class, 'usersList'])->middleware('isLoggedIn');
Route::get('admin/users-delete/{id}', [AdminController::class, 'usersDelete'])->middleware('isLoggedIn');

// Admin
Route::get('admin/admins-list', [AdminController::class, 'adminsList'])->middleware('isLoggedIn');
Route::get('admin/admins-add', [AdminController::class, 'adminsAdd'])->middleware('isLoggedIn');
Route::post('admin/admins-save', [AdminController::class, 'adminsSave'])->middleware('isLoggedIn');
Route::get('admin/admins-edit/{id}', [AdminController::class, 'adminsEdit'])->middleware('isLoggedIn');
Route::post('admin/admins-update', [AdminController::class, 'adminsUpdate'])->middleware('isLoggedIn');
Route::get('admin/admins-delete/{id}', [AdminController::class, 'adminsDelete'])->middleware('isLoggedIn');

// Feedback
Route::get('admin/feedbacks-list', [AdminController::class, 'feedbacksList'])->middleware('isLoggedIn');
Route::get('admin/feedbacks-delete/{id}', [AdminController::class, 'feedbacksDelete'])->middleware('isLoggedIn');

// Order
Route::get('admin/orders-list', [AdminController::class, 'ordersList'])->middleware('isLoggedIn');
Route::get('admin/orders-delete/{id}', [AdminController::class, 'ordersDelete'])->middleware('isLoggedIn');
Route::get('admin/orders-edit/{id}', [AdminController::class, 'ordersEdit'])->middleware('isLoggedIn');
Route::post('admin/orders-update', [AdminController::class, 'ordersUpdate'])->middleware('isLoggedIn');
Route::get('admin/orders-detail/{id}', [AdminController::class, 'ordersDetail'])->middleware('isLoggedIn');

// Customer view
Route::get('customer/index', [CustomerController::class, 'index'])->name('home');
Route::get('customer/login-customer', [CustomerController::class, 'login'])->name('customerLogin');
Route::post('customer/loginProcess', [CustomerController::class, 'loginProcess'])->name('userLoginProcess');

Route::get('customer/forgot-password', [CustomerController::class, 'showForgotPasswordForm'])->name('getForgotPassword');
Route::post('customer/forgot-password', [CustomerController::class, 'sendResetLinkEmail'])->name('postForgotPassword');
Route::get('customer/reset-password/{token}', [CustomerController::class, 'showResetPasswordForm'])->name('getResetPassword');
Route::post('customer/reset-password/{token}', [CustomerController::class, 'resetPassword'])->name('updatePassword');

Route::get('customer/logout', [CustomerController::class, 'logout'])->name('customerLogout');
Route::get('customer/register-customer', [CustomerController::class, 'register']);
Route::post('customer/registerProcess', [CustomerController::class, 'registerProcess'])->name('userRegisterProcess');
Route::get('customer/list-products', [CustomerController::class, 'listProducts'])->name('customerListProducts');
Route::get('customer/detail-products/{id}', [CustomerController::class, 'detailProducts'])->name('customerDetailProducts');
Route::get('customer/about', [CustomerController::class, 'aboutUs'])->name('aboutUs');

Route::get('customer/user-profile/{id}', [CustomerController::class, 'userProfile'])->name('userProfile');
Route::post('customer/delete-account/{id}', [CustomerController::class, 'deleteAccount'])->name('deleteAccount');
Route::post('customer/update-profile/{id}', [CustomerController::class, 'updateUserProfile'])->name('updateUserProfile');
Route::post('customer/update-avatar/{id}', [CustomerController::class, 'updateUserAvatar'])->name('updateUserAvatar');
Route::post('customer/change-password/{id}', [CustomerController::class, 'changePassword'])->name('changePassword');
Route::post('customer/submit-feedback/{id}', [CustomerController::class, 'userFeedback'])->name('userFeedback');

//Check login for user
Route::middleware(['customAuth'])->group(function () {
    Route::get('customer/cart', [CustomerController::class, 'cart'])->name('cart');
    Route::post('customer/add-to-cart/{id}', [CustomerController::class, 'addToCart']);
    Route::get('customer/remove-from-cart/{id}', [CustomerController::class, 'removeFromCart']);
    Route::post('customer/confirm-order-page/{id}', [CustomerController::class, 'comfirmOrderPage']);
    Route::get('customer/input-user/{id}', [CustomerController::class, 'inputUser'])->name('inputUser');
    Route::post('customer/add-order',[CustomerController::class, 'addOrder']);
});



// login with facebook
Route::get('customer/login-customer/facebook', [CustomerController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('customer/login-customer/facebook/callback', [CustomerController::class, 'handleFacebookCallback']);

// login with google
Route::get('customer/login-customer/google', [CustomerController::class, 'redirectToGoogle'])->name('login.google');
Route::get('customer/login-customer/google/callback', [CustomerController::class, 'handleGoogleCallback']);
