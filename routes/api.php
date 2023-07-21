<?php

// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('refresh', [AuthController::class, 'refresh']);

Route::post('verifyOptin', [AuthController::class, 'verifyDoubleOptin']);

Route::middleware('jwt.auth')->group(function () {
    // Define your authenticated routes here
});
Route::group(['middleware' => ['jwt.auth', 'admin']], function () {
    // Admin-only routes
    // ...
});