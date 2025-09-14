<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ImageController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/testExample', function (Request $request) {
    return 'Ok';
});

Route::get('/buildings/filter', [BuildingController::class, 'filter']);
Route::apiResource('buildings', BuildingController::class);
Route::apiResource('images', ImageController::class);
