<?php

use Illuminate\Database\Seeder;

use App\Models\Race;
use App\Models\Stage;
use App\Models\WeatherEffect;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weathers = WeatherEffect::all();
        $stages = Stage::all();
        $races = [];
        foreach($stages as $stage){         
            $weaherNum = mt_rand(0,2);
            for($i = 0;$i<$weaherNum;$i++){
            $weather = $this->getRandomWeather($weathers);
            $stage->weatherEffects()->attach($weather);
            $stage->save();
            }
            $raceDate = new DateTime("2023-08-23 12:00:00");
            $races[] = [
                'stage_id'=>$stage->id,
                'race_date' => $raceDate,
                'results' => '',
            ];
        }

        foreach ($races as $race) {
            Race::create($race);
        }
    }

    private function getRandomWeather($weatherEffects) {
        $types = [ 'wind', 'current', 'state_of_sea' ];
        $type = $types[ array_rand( $types ) ];
        $weathers = $weatherEffects->where("effect_type",$type);
        return $weathers->random();
        
    }
}
