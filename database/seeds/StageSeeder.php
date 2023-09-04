<?php

use Illuminate\Database\Seeder;
use App\Models\Stage;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stages = [
            [
                'starting_port' => 'Barcelona, Espanya',
                'ending_port' => 'Palma de Mallorca, Espanya',
                'distance' => 160,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Palma de Mallorca, Espanya',
                'ending_port' => 'Marsella, França',
                'distance' => 190,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Marsella, França',
                'ending_port' => 'Gènova, Itàlia',
                'distance' => 220,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Gènova, Itàlia',
                'ending_port' => 'Roma, Itàlia',
                'distance' => 180,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Roma, Itàlia',
                'ending_port' => 'Nàpols, Itàlia',
                'distance' => 160,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Nàpols, Itàlia',
                'ending_port' => 'Palerm, Itàlia',
                'distance' => 260,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Palerm, Itàlia',
                'ending_port' => 'Tunísia, Tunísia',
                'distance' => 170,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Tunísia, Tunísia',
                'ending_port' => 'Malta',
                'distance' => 220,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Malta',
                'ending_port' => 'Atenes, Grècia',
                'distance' => 360,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Atenes, Grècia',
                'ending_port' => 'Rodes, Grècia',
                'distance' => 250,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Rodes, Grècia',
                'ending_port' => 'Xipre',
                'distance' => 240,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Xipre',
                'ending_port' => 'Alejandría, Egipte',
                'distance' => 280,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Alejandría, Egipte',
                'ending_port' => 'Haifa, Israel',
                'distance' => 170,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Haifa, Israel',
                'ending_port' => 'Limassol, Xipre',
                'distance' => 130,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Limassol, Xipre',
                'ending_port' => 'Heraklion, Creta',
                'distance' => 260,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Heraklion, Creta',
                'ending_port' => 'Santorini, Grècia',
                'distance' => 70,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'Santorini, Grècia',
                'ending_port' => 'València, Espanya',
                'distance' => 360,
                'total_prize' => 500,
            ],
            [
                'starting_port' => 'València, Espanya',
                'ending_port' => 'Barcelona, Espanya',
                'distance' => 120,
                'total_prize' => 500,
            ],
            // Add more stages here
        ];

        foreach ($stages as $stage) {
            Stage::create($stage);
        }
    }
}