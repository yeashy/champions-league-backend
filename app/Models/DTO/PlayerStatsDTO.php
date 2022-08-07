<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PlayerStatsDTO implements interfaceDTO
{
    private string $name;
    private string $surname;
    private string $photo;
    private int $games;
    private float $avg_rate;
    private int $goals;
    private int $assists;
    private int $yellow_cards;
    private int $red_cards;

    public static function fromModel(Model $player)
    {
        return [
            "id" => $player->id,
            "name" => $player->name,
            "surname" => $player->surname,
            "photo" => $player->photo,
            "games" => $player->games,
            "avg_rate" => $player->avg_rate,
            "goals" => $player->goals,
            "assists" => $player->assists,
            "own_goals" => $player->own_goals,
            "yellow_cards" => $player->yellow_cards,
            "red_cards" => $player->red_cards,
            "clean_sheets" => $player->clean_sheets,
            "position" => $player->position->name
        ];
    }

    public static function fromRequest(Request $request)
    {
    }
}
