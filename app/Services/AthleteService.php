<?php

namespace App\Services;

use App\Models\Athlete;

class AthleteService extends Service
{
    public function getAll($shipId){
        $athletes = Athlete::whereNull("ship_id")->orWhere("ship_id",$shipId)->get();
        return $this->OkResult($athletes);
    }

    public function GetUnasigned(){
        $athletes = Athlete::whereNull("ship_id");
        return $this->OkResult($athletes);
    }

    public function createAthlete($name,$strength,$stamina,$experience,$price){
        $athlete = new Athlete();
        $athlete->name = $name;
        $athlete->strength = $strength;
        $athlete->stamina = $stamina;
        $athlete->experience = $experience;
        $athlete->price = $price;
        $athlete->save();

        return $this->OkResult($athlete);
    }
    public function removeAthlete($athleteId){
        $athlete = Athlete::find($athleteId);
        if(!$athlete || $athlete->ship_id) return $this->FailResponse("The athlete is assigned");;
        $athlete->delete();
        return $this->OkResult("Athlete deleted");
    }
}