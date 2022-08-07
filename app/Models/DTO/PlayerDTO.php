<?php

namespace App\Models\DTO;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PlayerDTO implements interfaceDTO
{

    public static function fromModel(Model $model)
    {

    }

    public static function fromRequest(Request $request)
    {
        $player = new Player();

        $player->name = $request->input('name');
        $player->surname = $request->input('surname');
        $player->photo = $request->input('photo');
        $player->club_id = $request->input('club_id');
        $player->position_id = $request->input('position_id');

        return $player;
    }
}
