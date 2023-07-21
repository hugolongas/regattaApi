<?php

// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShipController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('refresh', [AuthController::class, 'refresh']);

Route::post('verifyOptin', [AuthController::class, 'verifyDoubleOptin']);


Route::middleware('jwt.auth')->group(function () {
    Route::get('ship/get',[ShipController::class,'get']);
});
Route::group(['middleware' => ['jwt.auth', 'admin']], function () {
    // Admin-only routes
    // ...
});