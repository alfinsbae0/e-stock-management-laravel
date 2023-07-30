<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
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

//auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    //logout
    Route::post('logout', [AuthController::class, 'logout']);

    //category
    Route::get('category', [CategoryController::class, 'index']);
    Route::post('category', [CategoryController::class, 'store']);
    Route::get('category/{category}', [CategoryController::class, 'show']);
    Route::post('category/{category}', [CategoryController::class, 'update']);
    Route::get('category/delete/{category}', [CategoryController::class, 'destroy']);

    //product
    Route::get('product', [ProductController::class, 'index']);
    Route::post('product', [ProductController::class, 'store']);
    Route::get('product/{product}', [ProductController::class, 'show']);
    Route::post('product/{product}', [ProductController::class, 'update']);
    Route::get('product/delete/{product}', [ProductController::class, 'destroy']);
});
