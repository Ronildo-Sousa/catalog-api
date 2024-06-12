<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('categories', CategoryController::class)
        ->except(['index', 'show']);
});

Route::prefix('categories')->group(function() {
    Route::get('/{category}', [CategoryController::class, 'show'])
        ->name('categories.show');
});
