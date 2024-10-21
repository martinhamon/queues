<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ApiAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/events', [EventController::class, 'handleEvent']);




Route::group([

    'middleware' => ['api'],

    'prefix' => 'auth'

], function ($router) {


    Route::post('register', [ApiAuthController::class, 'register']);
    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('refresh', [ApiAuthController::class, 'refresh']);
    Route::post('logout', [ApiAuthController::class, 'logout']);

    
});



    Route::post('/test', [EventController::class, 'test']);

