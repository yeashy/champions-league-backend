<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClubGroupDTO implements InterfaceDTO
{

    public static function fromModel(Model $club)
    {
        return [
            "id" => $club->id,
            "name" => $club->name,
            "logo" => $club->logo,
            "games" => $club->games,
            "wins" => $club->wins,
            "draws" => $club->draws,
            "losses" => $club->losses,
            "goals_scored" => $club->goals_scored,
            "goals_conceded" => $club->goals_conceded,
            "goal_difference" => $club->goal_difference,
            "points" => $club->points,
            "group_place" => $club->group_place
        ];
    }

    public static function fromRequest(Request $request)
    {

    }
}
