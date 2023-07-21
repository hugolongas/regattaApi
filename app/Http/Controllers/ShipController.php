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
        $ship = $user->ship;
        $athletes = $ship->athletes
        $team = $user->team;
        $ship = $this->ShipService->getByUserId($user);        
        return response()->json(['ship'=>json_encode($ship)],200);
    }
}
