<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\MessagesController;
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
        Route::patch('{id}/client/finish', [SupportRequestController::class, 'clientFinishSupporRequest'])->name("supportrequest.finish.client");
        Route::get('{id}/client', [SupportRequestController::class, 'clientGetOneSupportRequest'])->name("supportrequest.getone.client");
        Route::get('', [SupportRequestController::class, 'supportGetAll'])->name("supportrequest.getall.support");
        Route::patch('{id}/manage', [SupportRequestController::class, 'supportGetOneToManage'])->name("supportrequest.manage.support");
        Route::patch('{id}/finish', [SupportRequestController::class, 'supportFinishService'])->name("supportrequest.finish.support");
    });
    Route::group([
        'prefix' => 'messages'
    ], function () {
        Route::post('', [MessagesController::class, 'supportAdd'])->name("message.add");
        Route::get('support-request/{id}', [MessagesController::class, 'getAll'])->name("message.getall");
    });
});
