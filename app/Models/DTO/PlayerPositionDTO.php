<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PlayerPositionDTO implements InterfaceDTO
{

    public static function fromModel(Model $player)
    {
        return [
            "id" => $player->id,
            "name" => $player->name,
            "surname" => $player->surname,
            "photo" => $player->photo,
            "current_rate" => $player->current_rate
        ];
    }

    public static function fromRequest(Request $request)
    {

    }
}
