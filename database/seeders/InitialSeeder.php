<?php

namespace Database\Seeders;

use App\Enums\Ampluas;
use App\Enums\NumOfClubs;
use App\Models\Club;
use App\Models\Formation;
use App\Models\Game;
use App\Models\Group;
use App\Models\Player;
use App\Models\Position;
use App\Models\Pot;
use App\Models\Stage;
use App\Models\Video;
use Illuminate\Database\Seeder;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createPlayer();
        $this->createGroup();
        $this->createPot();
        $this->createFormation();
        $this->createStage();
        $this->createVideo();
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

        $player = new Player();
        $player->name = "Karim";
        $player->surname = "Benzema";
        $player->photo = "path/to/photo/Benzema.webp";
        $player->club_id = 2;
        $player->position_id = 2;
        $player->save();
    }

    private function createGroup()
    {
        $group = new Group();
        $group->letter = "A";
        $group->save();

        $group = new Group();
        $group->letter = "B";
        $group->save();
    }

    private function createPot()
    {
        $pot = new Pot();
        $pot->save();
    }

    private function createFormation()
    {
        $formation = new Formation();
        $formation->name = "4-3-3";
        $formation->save();
    }

    private function createStage()
    {
        $stage = new Stage();
        $stage->name = "group";
        $stage->num_of_clubs = NumOfClubs::Group;
        $stage->is_active = true;
        $stage->save();
    }

    private function createVideo()
    {
        $video = new Video();
        $video->game_id = 1;
        $video->path = "path/to/video/123.mp4";
        $video->save();
    }
}
