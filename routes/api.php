<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * User Routes
 */
Route::ApiResource('users', 'User\UserController');
Route::get('users/verify/{token}', 'User\UserController@verify')->name('verify');
Route::get('users/{user}/resend', 'User\UserController@resend')->name('resend');

/**
 * Seller Routes
 */
Route::ApiResource('sellers', 'Seller\SellerController')->only(['index', 'show']);
Route::ApiResource('sellers.products', 'Seller\SellerProductController')->except('show');
Route::ApiResource('sellers.categories', 'Seller\SellerCategoryController')->only('index');
Route::ApiResource('sellers.transactions', 'Seller\SellerTransactionController')->only('index');
Route::ApiResource('sellers.buyers', 'Seller\SellerBuyerController')->only('index');

/**
 * Buyer Routes
 */
Route::ApiResource('buyers', 'Buyer\BuyerController')->only(['index', 'show']);
Route::ApiResource('buyers.transactions', 'Buyer\BuyerTransactionController')->only('index');
Route::ApiResource('buyers.products', 'Buyer\BuyerProductController')->only('index');
Route::ApiResource('buyers.categories', 'Buyer\BuyerCategoryController')->only('index');
Route::ApiResource('buyers.sellers', 'Buyer\BuyerSellerController')->only('index');

/**
 * Product Routes
 */
Route::ApiResource('products', 'Product\ProductController')->only(['index', 'show']);
Route::ApiResource('products.categories', 'Product\ProductCategoryController')->only(['index', 'update', 'destroy']);
Route::ApiResource('products.transactions', 'Product\ProductTransactionController')->only('index');
Route::ApiResource('products.buyers', 'Product\ProductBuyerController')->only('index');
Route::ApiResource('products.buyers.transactions', 'Product\ProductBuyerTransactionController')->only('store');

/**
 * Category Routes
 */
Route::ApiResource('categories', 'Category\CategoryController')->except(['create', 'edit']);
Route::ApiResource('categories.products', 'Category\CategoryProductController')->only('index');
Route::ApiResource('categories.sellers', 'Category\CategorySellerController')->only('index');
Route::ApiResource('categories.transactions', 'Category\CategoryTransactionController')->only('index');
Route::ApiResource('categories.buyers', 'Category\CategoryBuyerController')->only('index');

/**
 * Transaction Routes
 */
Route::ApiResource('transactions', 'Transaction\TransactionController')->only(['index', 'show']);
Route::ApiResource('transactions.categories', 'Transaction\TransactionCategoryController')->only('index');
Route::ApiResource('transactions.sellers', 'Transaction\TransactionSellerController')->only('index');

/**
 * OAuth Routes
 */
Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');