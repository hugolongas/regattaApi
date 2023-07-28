<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\AthleteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Athlete;

class AthleteController extends Controller
{
    private $AthleteService;

    public function __construct(AthleteService $athleteService)
    {
        $this->AthleteService = $athleteService;
    }

    public function GetAll(){
        $result = $this->AthleteService->getAll();
        return response()->json($result,200);
    }

    public function GetUnasigned(){
        $athletes = $this->AthleteService->getUnasigned();
        return response()->json($result,200);
    }

    public function Add(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'strength' => 'required|integer|between:1,10',
            'stamina' => 'required|integer|between:1,10',
            'experience' => 'required|integer|between:1,5',
            'price' => 'required|integer|between:1,100',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }
        $athlete = $this->AthleteService->createAthlete($request->name,$request->strength,$request->stamina,$request->experience,$request->price);
        return response()->json($athlete,200); 
    }

    public function Remove($athleteId){
        $response = $this->AthleteService->removeAthlete($athleteId);
        return response()->json($response,200);
    }
}
