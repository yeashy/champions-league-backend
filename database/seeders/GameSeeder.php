<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $game = new Game();
        $game->home_club_id = 1;
        $game->away_club_id = 2;
        $game->stage_id = 1;
        $game->group_id = 1;
        $game->save();

        $game = new Game();
        $game->home_club_id = 3;
        $game->away_club_id = 1;
        $game->stage_id = 1;
        $game->group_id = 1;
        $game->save();
    }
}
