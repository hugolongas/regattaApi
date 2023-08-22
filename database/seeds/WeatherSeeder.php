<?php

use Illuminate\Database\Seeder;
use App\Models\WeatherEffect;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $upgrades = [];

        for ( $i = 0; $i < 5; $i++ ) {
            $type = 'wind';
            $value = ($i+1)*2;
            $name = "vent al ".$value."";
            $description = "La força del vent fa reduir la velocitat un ".$value."%";
            
            $watherEffects[] = [
                'name'=>$name,
                'effect_type' => $type,
                'value' => $value,
                'description' => $description,
            ];
        }

        for ( $i = 0; $i < 5; $i++ ) {
            $type = 'current';
            $value = ($i+1)*2;
            $name = "corrent al ".$value."";
            $description = "La corrent d'aigua fa reduir l'acceleració un ".$value."%";
            
            $watherEffects[] = [
                'name'=>$name,
                'effect_type' => $type,
                'value' => $value,
                'description' => $description,
            ];
        }
        for ( $i = 0; $i < 5; $i++ ) {
            $type = 'state_of_sea';
            $value = $i+1;
            $name = "Ones de ".$value." metres";
            $description = "L'estat del mar, provoca que els mariners amb una experiencia menor a ".$value." no puguin navegar";
            
            $watherEffects[] = [
                'name'=>$name,
                'effect_type' => $type,
                'value' => $value,
                'description' => $description,
            ];
        }

        foreach ( $watherEffects as $wEffect ) {
            WeatherEffect::create( $wEffect );
        }
    }
}
