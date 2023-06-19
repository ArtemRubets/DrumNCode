<?php

use App\Http\Controllers\Api\v1\TaskController;
use App\Http\Resources\v1\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
    Route::post('logout', [\App\Http\Controllers\AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new UserResource($request->user());
});

Route::apiResource('tasks', TaskController::class);
Route::patch('tasks/{task}/change-status', [TaskController::class, 'changeStatus'])->name('tasks.change-status');
