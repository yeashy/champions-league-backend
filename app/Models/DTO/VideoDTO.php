<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class VideoDTO implements InterfaceDTO
{
    private int $player_id;
    private int $game_id;
    private string $path;

    public static function fromModel(Model $video)
    {
        return [
            "id" => $video->id,
            "player_id" => $video->player_id,
            "game_id" => $video->game_id,
            "path" => $video->path
        ];
    }

    public static function fromRequest(Request $request)
    {

    }
}
