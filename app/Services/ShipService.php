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

        return $this->OkResult($ship);
    }

    public function changeName($userId, $name)
    {
        $ship = Ship::where('user_id', '=', $userId)->first();
        $ship->name = $name;
        return $this->OkResult($ship);
    }

    public function getByUserId($userId)
    {
        $ship = Ship::where('user_id', '=', $userId)->with('athletes')->with('upgrades')->first();
        return $this->OkResult($ship);
    }


    public function addAthlete(User $user, $athleteId)
    {
        
        $athlete = Athlete::find($athleteId);
        if (!$athlete || $athlete->ship_id) return false;

        $ship = Ship::where('user_id', '=', $user->id)->with('athletes')->first();
        if ($ship->current_crew >= $ship->max_crew) return false;

        if ($user->money < $athlete->price) return false;

        $athlete->ship_id = $ship->id;
        $athlete->save();

        $ship->current_crew++;
        $ship->save();

        $user->money -= $athlete->price;
        $user->save();

        return $this->OkResult(true);
    }

    public function removeAthlete(User $user, $athleteId)
    {
        
        $athlete = Athlete::find($athleteId);
        if (!$athlete) return false;

        $ship = Ship::where('user_id', '=', $user->id)->with('athletes')->first();
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

        return $this->OkResult(true);
    }

    public function addUpgrade(User $user, $upgradeId)
    {
        $upgrade = Upgrade::find($upgradeId);
        if (!$upgrade) return "upgradeNoExist";

        $ship = Ship::where('user_id', '=', $user->id)->with('upgrades')->first();
        
        if ($user->money < $upgrade->price) return "NoMoney";

        // Handle crew upgrade separately
        if ($upgrade->upgrade_type === 'crew') {
            $ship->max_crew += $upgrade->value;
        }

        // Add the upgrade to the ship (including crew upgrades)
        $ship->upgrades()->attach($upgradeId);

        // Save the updated ship
        $ship->save();

        // Deduct the upgrade price from user's money
        $user->money -= $upgrade->price;
        $user->save();

        return true;
    }
    public function removeUpgrade(User $user, $upgradeId)
    {
        $ship = Ship::where('user_id', '=', $user->id)->with('upgrades')->first();
        // Check if the upgrade is attached to the ship
        if (!$ship->upgrades()->where('upgrade_id', $upgradeId)->exists()) {
            return "doesent exit";
        }

        $upgrade = Upgrade::findOrFail($upgradeId);

        // Handle crew upgrade separately
        if ($upgrade->type === 'crew') {
            // Check if removing the crew upgrade will result in exceeding the current crew count
            if ($ship->current_crew > ($ship->max_crew - $upgrade->value)) {
                return "crew error";
            }

            // Subtract the value from the max_crew of the ship
            $ship->max_crew -= $upgrade->value;
        }

        // Remove the upgrade from the ship (including crew upgrades)
        $ship->upgrades()->detach($upgradeId);

        // Save the updated ship
        $ship->save();

        // Add the upgrade price to user's money
        $user->money += $upgrade->price;
        $user->save();

        return true;
    }
}
