<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\healthCheckController;
use App\Http\Controllers\hubController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', [healthCheckController::class, 'index']);
Route::post('/hub', [hubController:: class, 'getSearch']);