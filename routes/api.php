<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('media', MediaController::class);


Route::get('users/{user}', [UserController::class, 'show']);

Route::post('users/{user}/collection', [
    UserController::class, 'addToCollection'
]);

Route::delete('users/{user}/collection/{media}', [
    UserController::class, 'removeFromCollection'
]);

