<?php

namespace App\Models\DTO;

use App\Models\Game;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GameDTO implements InterfaceDTO
{

    public static function fromModel(Model $game)
    {
        return [
            "id" => $game->id,
            "home_scored" => $game->home_scored,
            "away_scored" => $game->away_scored,
            "has_played" => $game->has_played
        ];
    }

    public static function fromRequest(Request $request)
    {
        $game = new Game();

        $game->home_club_id = $request->input('home_club_id');
        $game->away_club_id = $request->input('away_club_id');
        $game->stage_id = $request->input('stage_id');
        $game->group_id = $request->input('group_id');

        return $game;
    }
}
