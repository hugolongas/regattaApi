<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\LeaderBoardService;

class LeaderBoardController extends Controller
{
    private $LeaderBoardService;

    public function __construct(LeaderBoardService $leaderboardService)
    {
        $this->LeaderBoardService = $leaderboardService;
    }

    public function GetTeams(){
        $teams = $this->LeaderBoardService->getAll();
        return response()->json($teams,200);
    }

    public function GetLeaderBoard(){
        $users = $this->LeaderBoardService->leaderBoard();
        return response()->json($users,200);
    }
}
