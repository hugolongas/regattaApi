<?php

namespace App\Services;

use App\Models\Upgrade;

class UpgradeService extends Service
{
    public function getAll(){
        $upgrades = Upgrade::all();
        return $this->OkResult($upgrades);
    }

    public function getUpgradeTypes(){
        $upgradeTypes = ['speed', 'acceleration', 'crew', 'prize'];
        return $this->OkResult($upgradeTypes);
    }

    public function createUpgrade($name,$description,$upgrade_type,$value,$price){
        $upgrade = new Upgrade();
        $upgrade->name = $name;
        $upgrade->description = $description;
        $upgrade->upgrade_type = $upgrade_type;
        $upgrade->value = $value;
        $upgrade->price = $price;
        $upgrade->save();

        return $this->OkResult($upgrade);
    }

    public function deleteUpgrade($upgradeId){
        $upgrade = Upgrade::find($upgradeId)->withCount('ships')->get();
        if(!$upgrade || $upgrade->ships_count>0) return $this->FailResponse("The upgrade is assigned");;
        $upgrade->delete();
        return $this->OkResult("Upgrade deleted");
    }
}