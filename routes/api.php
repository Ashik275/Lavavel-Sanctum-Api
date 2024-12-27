<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('signup',[AuthController::class,'signup']);
Route::post('login',[AuthController::class,'login']);

Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

## Route por api resource

Route::apiResource('posts',PostController::class)->middleware('auth:sanctum');


## group route for au
// Route::middleware('auth.sanctum')->group(function(){
//     Route::post('logout',[AuthController::class,'logout']);
//     Route::apiResource('posts',PostController::class);
// });