<?php

namespace App\Services;

use App\Models\Team;

class AthleteService extends Service
{
    public function getAll(){
        $teams = Team::all()->orderby('points');
        $teams->users;
        return $this->OkResponse($teams);
    }

    public function bestSailor(){
        $user = User::Where('is_admin','0')->orderby('points')->first();
        return $this->OkResponse($user);
    }

    public function leaderBoard(){
        $users = User::Where('is_admin','0')->orderby('points');
        return $this->OkResponse($users);
    }
}