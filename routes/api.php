<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

//mặc định laravel thêm tiền tố api => với test -> api/test
Route::get('/test', function () {
    return response()->json([
        'success' => true,
        'message' => 'test api',
        'status_code' => 200,
    ], 201);
});

// Route::post('/todos', [TodoController::class, 'store']);
// Route::get('/todos', [TodoController::class, 'index']);
// Route::get('/todos/{id}', [TodoController::class, 'show']);
// Route::put('/todos/{id}', [TodoController::class, 'update']);
// Route::delete('/todos/{id}', [TodoController::class, 'destroy']);
Route::apiResource('/todos', TodoController::class);
