<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\RaceService;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RaceController extends Controller
 {
    private $RaceService;

    public function __construct( RaceService $raceService )
 {
        $this->RaceService = $raceService;
    }

    public function GetAll()
 {
        $result = $this->RaceService->getAll();
        return response()->json( $result, 200 );
    }

    public function simulateRaceByDate() {

        $date = new DateTime();
        $racedate = $date->format( 'Y-m-d H:i:00' );
        $result = $this->RaceService->simulateRaceByDate( $racedate );

        return response()->json( $result, 200 );

    }

    public function simulateById( $raceId ) {

        $result = $this->RaceService->simulateRaceById( $raceId );

        return response()->json( $result, 200 );

    }
}
