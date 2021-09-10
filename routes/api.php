<?php

use App\Http\Controllers\usersController;
use App\Http\Controllers\productController;
use App\Http\Controllers\regionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [usersController::class, 'index']);
Route::post('/users', [usersController::class, 'store']);

Route::get('/product', [productController::class, 'index']);
Route::post('/product', [productController::class, 'store']);

Route::get('/region/province', [regionController::class, 'province']);
Route::post('/region/city', [regionController::class, 'city']);
Route::post('/region/subdistrict', [regionController::class, 'subdistrict']);