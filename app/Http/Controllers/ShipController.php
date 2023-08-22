<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Services\ShipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ShipController extends Controller
{
    private $ShipService;

    public function __construct(ShipService $shipService)
    {
        $this->ShipService = $shipService;
    }

     public function Get()
     {
        $user = Auth::user();
        $result = $this->ShipService->getByUserId($user->id);   
        
        return response()->json($result,200);
    }

    public function AddAthleteToShip($athleteId){
        $user = Auth::user();        
        $result = $this->ShipService->addAthlete($user, $athleteId);
        return response()->json($result,200);
    }

    public function RemoveAthleteToShip($athleteId){
        $user = Auth::user();        
        $result = $this->ShipService->removeAthlete($user, $athleteId);
        return response()->json($result,200);
    }

    public function AddUpgradeToShip($upgradeId){
        $user = Auth::user();
        $result = $this->ShipService->addUpgrade($user,$upgradeId);
        return response()->json($result,200);
    }

    public function RemoveUpgradeToShip($upgradeId){
        $user = Auth::user();        
        $result = $this->ShipService->removeUpgrade($user, $upgradeId);
        return response()->json($result,200);
    }
}
