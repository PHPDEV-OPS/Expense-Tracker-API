<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('api/register', [AuthController::class, 'register']);
Route::post('api/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);

    // Expense CRUD
    Route::get('expenses', [\App\Http\Controllers\ExpenseController::class, 'index']);
    Route::post('expenses', [\App\Http\Controllers\ExpenseController::class, 'store']);
    Route::get('expenses/{id}', [\App\Http\Controllers\ExpenseController::class, 'show']);
    Route::put('expenses/{id}', [\App\Http\Controllers\ExpenseController::class, 'update']);
    Route::delete('expenses/{id}', [\App\Http\Controllers\ExpenseController::class, 'destroy']);
});
