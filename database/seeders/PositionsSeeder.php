<?php

namespace Database\Seeders;

use App\Enums\Ampluas;
use App\Enums\Positions;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createPositions();
    }

    private function createPositions()
    {
        $position = new Position();
        $position->amplua = Ampluas::Attacker;
        $position->name = Positions::ST;
        $position->save();

        $position = new Position();
        $position->amplua = Ampluas::Attacker;
        $position->name = Positions::CF;
        $position->save();

        $position = new Position();
        $position->amplua = Ampluas::Attacker;
        $position->name = Positions::RF;
        $position->save();

        $position = new Position();
        $position->amplua = Ampluas::Attacker;
        $position->name = Positions::LF;
        $position->save();

        $position = new Position();
        $position->amplua = Ampluas::Attacker;
        $position->name = Positions::RW;
        $position->save();

        $position = new Position();
        $position->amplua = Ampluas::Attacker;
        $position->name = Positions::LW;
        $position->save();

        $position = new Position();
        $position->amplua = Ampluas::Midfielder;
        $position->name = Positions::CAM;
        $position->save();

        $position = new Position();
        $position->amplua = Ampluas::Midfielder;
        $position->name = Positions::CM;
        $position->save();

        $position = new Position();
        $position->amplua = Ampluas::Midfielder;
        $position->name = Positions::RM;
        $position->save();

        $position = new Position();
        $position->amplua = Ampluas::Midfielder;
        $position->name = Positions::LM;
        $position->save();

        $position = new Position();
        $position->amplua = Ampluas::Midfielder;
        $position->name = Positions::CDM;
        $position->save();

        $position = new Position();
        $position->amplua = Ampluas::Defender;
        $position->name = Positions::CB;
        $position->save();

        $position = new Position();
        $position->amplua = Ampluas::Defender;
        $position->name = Positions::LB;
        $position->save();

        $position = new Position();
        $position->amplua = Ampluas::Defender;
        $position->name = Positions::RWB;
        $position->save();

        $position = new Position();
        $position->amplua = Ampluas::Defender;
        $position->name = Positions::LWB;
        $position->save();

        $position = new Position();
        $position->amplua = Ampluas::Goalkeeper;
        $position->name = Positions::GK;
        $position->save();
    }
}
