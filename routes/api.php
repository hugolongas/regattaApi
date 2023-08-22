<?php

// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\UpgradeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\RaceController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::post('verifyOptin', [AuthController::class, 'verifyDoubleOptin']);

Route::get('teams/all',[TeamController::class,'getAll']);

Route::post('logout', [AuthController::class, 'logout']);

Route::post('race/simulateId/{raceId}',[RaceController::class,'simulateById']);

Route::middleware('jwt.auth')->group(function () {
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user',[AuthController::class,'user']);

    Route::get('athlete/all',[AthleteController::class,'getAll']);
    Route::get('athlete/allunasigned',[AthleteController::class,'getunasigned']);

    Route::get('ship/get',[ShipController::class,'get']);

    Route::post('ship/addathlete/{athleteId}',[ShipController::class,'addathletetoship']);
    Route::post('ship/removeathlete/{athleteId}',[ShipController::class,'removeathletetoship']);    
    Route::post('ship/addupgrade/{upgradeId}',[ShipController::class,'addupgradetoship']);
    Route::post('ship/removeupgrade/{upgradeId}',[ShipController::class,'removeupgradetoship']);    

    Route::post('athlete/add',[AthleteController::class,'add']);
    Route::delete('athlete/remove/{athleteId}',[AthleteController::class,'remove']);    
    
    Route::post('upgrade/add',[UpgradeController::class,'add']);
    Route::delete('upgrade/remove/{upgradeId}',[UpgradeController::class,'remove']);   

    Route::get('upgrades/all',[UpgradeController::class,'getAll']);
    Route::get('race/all',[RaceController::class,'getAll']);
    //Route::post('race/simulateId/{raceId}',[RaceController::class,'simulateById']);
});
Route::group(['middleware' => ['jwt.auth', 'admin']], function () {
    
});