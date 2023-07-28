<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ship;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array();
        // Generate 1000 character records
        for ($i = 1; $i <= 1000; $i++) {

            $user = [
                'name' => $this->generateRandomCatalanName(),
                'team_id' => rand(1,5),
                'email' => 'hugolo3.'.$i.'@mailinator.com',
                'email_verified_at' => now(),
                'password' => \Hash::make("password")                
            ];
            array_push($users,$user);
        }
        foreach ($users as $u) {
            $user = User::create($u);
            $ship = new Ship();
            $ship->user_id = $user->id;
            $ship->name = "vaixell";
            $ship->initial_crew = 6;
            $ship->current_crew = 0;
            $ship->max_crew = 6;
            $ship->speed = 5;
            $ship->acceleration = 2;
            $ship->save();
        }
    }

    
    
    private function generateRandomCatalanName()
    {
        // Define an array of Catalan names
        $names = [
            'Marc', 'Laia', 'Pol', 'Marta', 'Jordi', 'Laura', 'Arnau', 'Carla', 'Pau', 'Júlia',
            'Nil', 'Alba', 'Guillem', 'Mariona', 'Àlex', 'Laia', 'Biel', 'Jana', 'Àngel', 'Gemma',
            'Jan', 'Marina', 'Gerard', 'Paula', 'Martí', 'Aina', 'Hugo', 'Ona', 'Adam', 'Blanca',
            'Enric', 'Berta', 'Aleix', 'Clara', 'Bruno', 'Maria', 'Eric', 'Núria', 'Hèctor', 'Sofia',
            'Adrià', 'Vera', 'Oriol', 'Neus', 'Eric', 'Abril', 'Lluc', 'Irene', 'Ian', 'Emma'
        ];

        $surnames = [
            'Martínez', 'Garcia', 'Roca', 'Ferrer', 'Torres', 'Pujol', 'Soler', 'Costa', 'Bosch', 'Vidal',
            'Serra', 'Noguera', 'Mestre', 'Vilanova', 'Riera', 'Balaguer', 'Esteban', 'Cardona', 'Canals', 'Fuentes',
            'Capdevila', 'Roura', 'Escudero', 'Roig', 'Batlle', 'Mas', 'Ortega', 'Bosch', 'Gómez', 'Duran',
            'Busquets', 'Tarrés', 'Pla', 'Ribas', 'López', 'Corominas', 'Solà', 'Ventura', 'Delgado', 'Freixa',
            'Mora', 'Marín', 'Puig', 'Fabregat', 'Casas', 'Grau', 'Colom', 'Peralta', 'Viñas', 'Prats'
        ];

        $fullName = $names[array_rand($names)]." ".$surnames[array_rand($surnames)];

        // Return a random name from the array
        return $fullName;
    }
}
