<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Group;
use App\Models\Player;
use App\Models\Position;
use App\Models\Pot;
use Illuminate\Database\Seeder;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createPlayer();
        $this->createClub();
        $this->createPosition();
        $this->createGroup();
        $this->createPot();
    }

    private function createPlayer()
    {
        $player = new Player();
        $player->name = "Jack";
        $player->surname = "Grealish";
        $player->photo = "path/to/photo/Grealish.webp";
        $player->club_id = 1;
        $player->position_id = 1;
        $player->save();
    }

    private function createPosition()
    {
        $position = new Position();
        $position->amplua = config('constants.ampluas.attacker');
        $position->name = "ST";
        $position->save();
    }

    private function createClub()
    {
        $club = new Club();
        $club->name = "Manchester City";
        $club->logo = "path/to/logo/Manchester_City.webp";
        $club->group_id = 1;
        $club->pot_id = 1;
        $club->save();
    }

    private function createGroup()
    {
        $group = new Group();
        $group->letter = "A";
        $group->save();
    }

    private function createPot()
    {
        $pot = new Pot();
        $pot->save();
    }
}
