<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PlayerStatsDTO implements interfaceDTO
{
    public string $name;
    public string $surname;
    public string $photo;
    public int $games;
    public float $avg_rate;
    public int $goals;
    public int $assists;
    public int $yellow_cards;
    public int $red_cards;

    public static function fromModel(Model $player)
    {
        return [
            "name" => $player->name,
            "surname" => $player->surname,
            "photo" => $player->photo,
            "games" => $player->games,
            "avg_rate" => $player->avg_rate,
            "goals" => $player->goals,
            "assists" => $player->assists,
            "yellow_cards" => $player->yellow_cards,
            "red_cards" => $player->red_cards,
        ];
    }

    public static function fromRequest(Request $request)
    {
    }
}
