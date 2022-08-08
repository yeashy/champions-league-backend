<?php

namespace Database\Seeders;

use App\Models\Club;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $club = new Club();
        $club->name = "Manchester City";
        $club->logo = "path/to/logo/Manchester_City.webp";
        $club->group_id = 1;
        $club->pot_id = 1;
        $club->save();

        $club = new Club();
        $club->name = "Real Madrid";
        $club->logo = "path/to/logo/Real_Madrid.webp";
        $club->group_id = 1;
        $club->pot_id = 1;
        $club->save();

        $club = new Club();
        $club->name = "Wolfsburg";
        $club->logo = "path/to/logo/Wolsborg.webp";
        $club->group_id = 1;
        $club->pot_id = 1;
        $club->save();

        $club = new Club();
        $club->name = "Salzburg";
        $club->logo = "path/to/logo/Salzburg.webp";
        $club->group_id = 1;
        $club->pot_id = 1;
        $club->save();
    }
}
