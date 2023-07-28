<?php

// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\AthleteController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::post('verifyOptin', [AuthController::class, 'verifyDoubleOptin']);


Route::middleware('jwt.auth')->group(function () {
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user',[AuthController::class,'user']);

    Route::get('athlete/all',[AthleteController::class,'getAll']);
    Route::get('athlete/allunasigned',[AthleteController::class,'getunasigned']);

    Route::get('ship/get',[ShipController::class,'get']);

    Route::post('ship/addathlete/{athleteId}',[ShipController::class,'addathletetoship']);
    Route::post('ship/removeathlete/{athleteId}',[ShipController::class,'removeathleteroship']);    

    Route::post('athlete/add',[AthleteController::class,'add']);
    Route::delete('athlete/remove/{athleteId}',[AthleteController::class,'remove']);    
});
Route::group(['middleware' => ['jwt.auth', 'admin']], function () {
    
});