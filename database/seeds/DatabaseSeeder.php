<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(TeamSeeder::class);
        //$this->call(StageSeeder::class);
        //$this->call(AthleteSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
