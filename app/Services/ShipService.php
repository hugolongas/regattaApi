<?php

namespace App\Services;

use App\Models\Ship;
use App\Models\User;

class ShipService
{
    public function createShip(User $user)
    {
        $ship = new Ship();
        $ship->user_id = $user->id;
        $ship->name = "vaixell";
        $ship->initial_crew = 6;
        $ship->current_crew = 0;
        $ship->max_crew = 6;
        $ship->speed = 5;
        $ship->acceleration = 2;
        $ship->save();
        
        return $ship;
    }
}