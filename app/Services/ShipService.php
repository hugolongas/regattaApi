<?php

namespace App\Services;

use App\Models\Ship;
use App\Models\User;
use App\Models\Athlete;
use App\Models\Upgrade;

class ShipService extends Service
{
    public function createShip($user)
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

    public function changeName($userId, $name){
    $ship = Ship::where('user_id','=',$userId)->first();
    $ship->name = $name;
    return $this->OkResponse($ship);
    }

    public function getByUserId($userId){
        $ship = Ship::where('user_id','=',$userId)->with('user')->with('athletes')->with('upgrades')->first();
        return $ship;
    }

    
    public function addAthlete(User $user, $athleteId) {
              
       $athlete = Athlete::find($athleteId);
       if(!$athlete || $athlete->ship_id) return false;
       
       $ship = $user->ship;
       if($ship->current_crew>=$ship->max_crew) return false;

       if($user->money<$athlete->price) return false;
       
       $athlete->ship_id = $ship->id;
       $athlete->save();
       
       $ship->current_crew++;
       $ship->save();
       
       $user->money -= $athlete->price;
       $user->save();
       
       return true;
    }

    public function removeAthlete(User $user, $athleteId)
    {
        $ship = Ship::where('user_id','=',$user->id)->first();
        $athlete = Athlete::find($athleteId);
        if(!$athlete) return false;
        if ($athlete->ship_id !== $ship->id) return false;

            // Remove the athlete from the ship
            $athlete->ship_id = null;
            $athlete->save();

            // Update ship's current crew count
            $ship->current_crew--;
            $ship->save();

            // Add athlete's price to user's money
            $user->money += $athlete->price;
            $user->save();

            return true;
    }
}