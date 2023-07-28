<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaderBoardController extends Controller
{
    private $LeaderBoardService;

    public function __construct(ShipService $leaderboardService)
    {
        $this->LeaderBoardService = $leaderboardService;
    }

    public function GetTeams(){
        $teams = $this->LeaderBoardService->getAll();
        return response()->json(['teams'=>json_encode($teams)],200);
    }

    public function GetBestSailor(){
        $sailor = $this->LeaderBoardService->bestSailor();
        return response()->json(['sailor'=>json_encode($sailor)],200);
    }

    public function GetLeaderBoard(){
        $users = $this->LeaderBoardService->leaderBoard();
        return response()->json(['leaderboard'=>json_encode($users)],200);
    }
}
