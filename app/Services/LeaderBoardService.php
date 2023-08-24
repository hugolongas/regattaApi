<?php

namespace App\Services;

use App\Models\Team;
use App\Models\User;

class LeaderBoardService extends Service
{
    public function getAll(){
        $teams = Team::all();
        return $this->OkResult($teams);
    }

    public function leaderBoard(){
        $users = User::Where('is_admin','0')->with('team')->orderby('points','desc')->get();
        return $this->OkResult($users);
    }
}