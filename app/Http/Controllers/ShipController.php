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
        $ship = $this->ShipService->getByUserId($user->id);   
        $athletes =$ship->athletes;
        return response()->json(['ship'=>json_encode($ship)],200);
    }

    public function AddAthleteToShip($athleteId){
        $user = Auth::user();        
        $result = $this->ShipService->addAthlete($user, $athleteId);
        return response()->json($result,200);
    }

    public function RemoveAthleteToShip($athleteId){
        $user = Auth::user();        
        $this->ShipService->removeAthlete($user, $athleteId);
        return response()->json(true,200);
    }
}
