<?php

use Illuminate\Database\Seeder;
use App\Models\Upgrade;

class UpgradesSeeder extends Seeder {

    /**
    * Run the database seeds.
    *
    * @return void
    */

    public function run() {
        $upgrades = [];

        for ( $i = 0; $i < 5; $i++ ) {
            $type = 'speed';
            $value = $this->getRandomValue( $type );
            $name = $this->getNameByType( $type, $value );
            $description = $this->getUpgradeDescription( $type, $value );
            $price = $this->getRandomPrice( $type );

            $upgrades[] = [
                'name'=>$name,
                'upgrade_type' => $type,
                'value' => $value,
                'description' => $description,
                'price' => $price,
            ];
        }
        for ( $i = 0; $i < 5; $i++ ) {
            $type = 'acceleration';
            $value = $this->getRandomValue( $type );
            $name = $this->getNameByType( $type, $value );
            $description = $this->getUpgradeDescription( $type, $value );
            $price = $this->getRandomPrice( $type );

            $upgrades[] = [
                'name'=>$name,
                'upgrade_type' => $type,
                'value' => $value,
                'description' => $description,
                'price' => $price,
            ];
        }
        for ( $i = 0; $i < 3; $i++ ) {
            $type = 'crew';
            $value = $this->getRandomValue( $type );
            $name = $this->getNameByType( $type, $value );
            $description = $this->getUpgradeDescription( $type, $value );
            $price = $this->getRandomPrice( $type );

            $upgrades[] = [
                'name'=>$name,
                'upgrade_type' => $type,
                'value' => $value,
                'description' => $description,
                'price' => $price,
            ];
        }
        for ( $i = 0; $i < 5; $i++ ) {
            $type = 'prize';
            $value = $this->getRandomValue( $type );
            $name = $this->getNameByType( $type, $value );
            $description = $this->getUpgradeDescription( $type, $value );
            $price = $this->getRandomPrice( $type );

            $upgrades[] = [
                'name'=>$name,
                'upgrade_type' => $type,
                'value' => $value,
                'description' => $description,
                'price' => $price,
            ];
        }

        foreach ( $upgrades as $upgrade ) {
            Upgrade::create( $upgrade );
        }
    }

    /**
    * Get a random upgrade type.
    *
    * @return string
    */

    private function getRandomUpgradeType() {
        $types = [ 'speed', 'acceleration', 'crew', 'prize' ];
        return $types[ array_rand( $types ) ];
    }

    /**
    * Generate a random value between the given range based on the upgrade type.
    *
    * @param string $type
    * @return int
    */

    private function getRandomValue( $type ) {
        switch ( $type ) {
            case 'speed':
            case 'acceleration':
            return 5;
            case 'crew':
            return 3;
            case 'prize':
            return mt_rand ( 1*10, 2*10 ) / 10;
            default:
            return 0;
        }
    }

    /**
    * Generate a random prize between the given range based on the upgrade type.
    *
    * @param string $type
    * @return int
    */

    private function getRandomPrice( $type ) {
        switch ( $type ) {
            case 'speed':                
            case 'acceleration':
                return 50;
            case 'crew':
                return 50;
            case 'prize':
            return mt_rand( 10, 20 );
            default:
            return 0;
        }
    }

    /**
    * Generate the upgrade description based on the type and value.
    *
    * @param string $type
    * @param int $value
    * @return string
    */

    private function getUpgradeDescription( $type, $value ) {
        $descriptions = [
            'speed' => [
                "S'han canviat les veles aconseguint un increment del {$value}% en la velocitat.",
                "S'ha canviat el material dels rems aconseguint un increment del {$value}% en la velocitat."
            ],
            'acceleration' => [
                "S'ha modificat una mica la forma de la quilla, s'ha aconseguit un increment del {$value}% en l'acceleració.",
                "Es modifica l'area de descans dels tripulants, s'ha aconseguit un increment del {$value}% en l'acceleració."
            ],
            'crew' => [
                "S'ha ampliat l'eslora de l'embarcació, s'incrementa la quantitat de tripulants en {$value}."
            ],
            'prize' => [
                "Gracies a un error de l'organització obtens un increment del {$value}% en els premis rebuts."
            ],
        ];

        $description = $descriptions[ $type ][ array_rand( $descriptions[ $type ] ) ];

        return $description;
    }

    private function getNameByType( $type, $value ) {
        switch ( $type ) {
            case 'speed':
            return "Millora de velocitat. (5%)";
            case 'acceleration':
            return "Millora d'acceleració. (5%)";
            case 'crew':
            return "Millora de tripulació. (3)";
            case 'prize':
            return "Multiplicador de premis. ({$value}%)";
            default:
            return '';
        }
    }
}
