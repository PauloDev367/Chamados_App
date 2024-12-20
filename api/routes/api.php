<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\SupportRequestController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/v1/auth/login', [AuthController::class, 'login']);
Route::group([
    'middleware' => 'auth:api',
    'prefix' => '/v1/auth'
], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});


Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'v1'
], function () {
    Route::group([
        'prefix' => 'support-requests'
    ], function () {
        Route::post('', [SupportRequestController::class, 'create'])->name("supportrequest.create");
        Route::get('client', [SupportRequestController::class, 'getAllFromClient'])->name("supportrequest.get.client");
    });
});
