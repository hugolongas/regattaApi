<?php

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create 5 teams
        $teams = [
            [
                'name' => 'Bisky',
                'logo' => 'bisky_logo.png',
                'total_points' => 0,
            ],
            [
                'name' => 'concos',
                'logo' => 'concos_logo.png',
                'total_points' => 0,
            ],
            [
                'name' => 'Can t\'Implora',
                'logo' => 'can_implora_logo.png',
                'total_points' => 0,
            ],
            [
                'name' => 'Skando',
                'logo' => 'skando_logo.png',
                'total_points' => 0,
            ],
            [
                'name' => 'Sporting l\'Olla',
                'logo' => 'sporting_olla_logo.png',
                'total_points' => 0,
            ],
        ];

        // Insert teams into the database
        foreach ($teams as $teamData) {
            Team::create($teamData);
        }
    }
}
