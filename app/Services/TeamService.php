<?php

namespace App\Services;

use App\Models\Team;

class TeamService extends Service
{
    public function getAll(){
        $teams = Team::all();
        return $this->OkResult($teams);
    }
}