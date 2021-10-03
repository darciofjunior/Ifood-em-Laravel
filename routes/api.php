<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\EvaluationApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\TableApiController;
use App\Http\Controllers\Api\TenantApiController;
use App\Http\Controllers\Api\Auth\AuthClientController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\OrderApiController;

Route::post('/auth/register', [RegisterController::class, 'store']);
Route::post('/auth/token', [AuthClientController::class, 'auth']);

Route::group([
    'middleware' => ['auth:sanctum']
], function() {
    Route::get('/auth/me', [AuthClientController::class, 'me']);
    Route::post('/auth/logout', [AuthClientController::class, 'logout']);

    Route::post('/auth/v1/orders/{identifyOrder}/evaluations', [EvaluationApiController::class, 'store']);

    Route::get('/auth/v1/my-orders', [OrderApiController::class, 'myOrders']);
    Route::post('/auth/v1/orders', [OrderApiController::class, 'store']);
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function() {
    Route::get('/tenants', [TenantApiController::class, 'index']);
    Route::get('/tenants/{uuid}', [TenantApiController::class, 'show']);
    
    Route::get('/categories', [CategoryApiController::class, 'categoriesByTenant']);
    Route::get('/categories/{identify}', [CategoryApiController::class, 'show']);
  
    Route::get('/tables', [TableApiController::class, 'tablesByTenant']);
    Route::get('/tables/{identify}', [TableApiController::class, 'show']);
    
    Route::get('/products', [ProductApiController::class, 'productsByTenant']);
    Route::get('/products/{identify}', [ProductApiController::class, 'show']);
    
    Route::post('/client', [RegisterController::class, 'store']);

    Route::post('/orders', [OrderApiController::class, 'store']);
    Route::get('/orders/{identify}', [OrderApiController::class, 'show']);
});

/**
* Test API 
*/
Route::get('/', function() {
    return response()->json(['message' => 'ok']);
});
