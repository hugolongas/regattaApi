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
        $users = User::with('team')
        ->Where('is_admin','0')
        ->whereNotNull('team_id')
        ->orderby('points','desc')->get();
        $userDashboard = [];
        foreach ($users as $index => $user)
        {
            $userDashboard[] = [
                'position'=>$index+1,
                'name'=>$user->name,
                'team'=>$user->team->name,
                'points'=>$user->points
            ];
        }
        return $this->OkResult($userDashboard);
    }
}