<?php

use Illuminate\Database\Seeder;
use App\Models\Athlete;

class AthleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $athletes = array();
        // Generate 1000 character records
        for ($i = 1; $i <= 4000; $i++) {
            $strength = rand(1, 10);
            $stamina = rand(1, 10);
            $experience = rand(1, 5);
            $price = $this->calculatePrice($strength, $stamina, $experience);

            $athlete = [
                'name' => $this->generateRandomCatalanName(),
                'strength' => $strength,
                'stamina' => $stamina,
                'experience' => $experience,
                'price' => $price
            ];
            array_push($athletes, $athlete);
        }
        foreach ($athletes as $athlete) {
            Athlete::create($athlete);
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
            'Adrià', 'Vera', 'Oriol', 'Neus', 'Eric', 'Abril', 'Lluc', 'Irene', 'Ian', 'Emma',
            'Sergio', 'Andrea', 'Daniela', 'Raúl', 'Carla', 'Juan', 'Elena', 'Pedro', 'Rosa',
            'Miguel', 'Lucía', 'Iván', 'Silvia', 'Diego', 'Patricia', 'Andrés', 'Alicia', 'Javier',
            'Beatriz', 'Pablo', 'Isabel', 'Luis', 'Martina', 'Alejandro', 'Valeria', 'Álvaro', 'Sofía',
            'José', 'Natalia', 'Mario', 'Laura', 'Francisco', 'Andrea', 'Gabriel', 'Paula', 'Fernando',
            'Clara', 'Guillermo', 'Marta', 'Ricardo', 'Marina', 'Antonio', 'Daniela', 'Gonzalo',
            'Carmen', 'Diego', 'Lorena', 'Víctor', 'Elena', 'Rodrigo'
        ];

        $surnames = [
            'Martínez', 'Garcia', 'Roca', 'Ferrer', 'Torres', 'Pujol', 'Soler', 'Costa', 'Bosch', 'Vidal',
            'Serra', 'Noguera', 'Mestre', 'Vilanova', 'Riera', 'Balaguer', 'Esteban', 'Cardona', 'Canals', 'Fuentes',
            'Capdevila', 'Roura', 'Escudero', 'Roig', 'Batlle', 'Mas', 'Ortega', 'Bosch', 'Gómez', 'Duran',
            'Busquets', 'Tarrés', 'Pla', 'Ribas', 'López', 'Corominas', 'Solà', 'Ventura', 'Delgado', 'Freixa',
            'Mora', 'Marín', 'Puig', 'Fabregat', 'Casas', 'Grau', 'Colom', 'Peralta', 'Viñas', 'Prats',
            'Fernández', 'López', 'González', 'Rodríguez', 'Martí', 'Sánchez', 'Ramírez', 'Pérez', 'Hernández', 'Díaz',
            'Álvarez', 'Romero', 'Navarro', 'Ramos', 'Cruz', 'Vargas', 'Reyes', 'Iglesias', 'Gómez', 'Flores',
            'Mendoza', 'Molina', 'Castro', 'Garrido', 'Vega', 'Campos', 'Guerrero', 'Pardo', 'Giménez', 'Méndez',
            'Cortés', 'Pascual', 'Vázquez', 'Herrera', 'León', 'Fuentes', 'Santos', 'Vera', 'Núñez', 'Espinosa',
            'Ríos', 'Bellido', 'Barrios', 'Muñoz', 'Soto', 'Gálvez', 'Jurado', 'Morales', 'Camacho', 'Salas'
        ];

        $fullName = $names[array_rand($names)] . " " . $surnames[array_rand($surnames)];

        // Return a random name from the array
        return $fullName;
    }

    private function calculatePrice($strength, $stamina, $experience)
    {
        // Define weightage factors for each stat
        $strengthWeight = 0.4;
        $staminaWeight = 0.3;
        $experienceWeight = 0.1;

        // Calculate the overall value of the character based on the stats and weightage
        $overallValue = ($strength * $strengthWeight) + ($stamina * $staminaWeight) + ($experience * $experienceWeight);

        // Scale the overall value to the price range (10 to 100)
        $minValue = 0; // Minimum value that a character can have
        $maxValue = 15; // Maximum value that a character can have (adjust this based on your desired range)
        $price = $minValue + ($overallValue / $maxValue) * (100 - $minValue);

        // Round the price to two decimal places
        return round($price, 2);
    }
}
