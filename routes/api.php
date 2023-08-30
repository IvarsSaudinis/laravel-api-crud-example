<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductAttributeController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [AuthController::class, 'createUser'])->name('api.createUser');
Route::post('/auth/login', [AuthController::class, 'loginUser'])->name('api.loginUser');;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/product', ProductController::class)->middleware('auth:sanctum');

Route::apiResource('/product-attribute', ProductAttributeController::class)->middleware('auth:sanctum');

Route::fallback(function(){
    return response()->json([
        'message' => 'API Endpoint Not Found'], 404);
});
