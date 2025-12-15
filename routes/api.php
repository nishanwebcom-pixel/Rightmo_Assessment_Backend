<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Middleware\OnlyForAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::middleware([
    'auth:sanctum',
    OnlyForAdminMiddleware::class
])->group(function () {
    Route::resource('products', ProductController::class);
});

Route::get('/temporary-file/{filename}', function ($filename) {
    if (!request()->hasValidSignature()) {
        abort(403);
    }

    $filePath = $filename;
    if (!Storage::disk('public')->exists("/uploads/{$filePath}")) {
        abort(404);
    }
    return response()->file(
        Storage::disk('public')->path("/uploads/{$filePath}")
    );

})->name('temporary.file');


