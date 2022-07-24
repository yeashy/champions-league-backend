<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlayerRequest;
use App\Models\DTO\ClubPlayerDTO;
use App\Models\DTO\PlayerStatsDTO;
use App\Models\Player;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function read(int $id)
    {
        $player = Player::find($id);

        if ($player === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ])->setStatusCode(404);
        }

        return response()->json([
            "player" => $player
        ]);
    }

    public function create(CreatePlayerRequest $request)
    {
        $player = new Player();

        $player->name = $request->input('name');
        $player->surname = $request->input('surname');
        $player->photo = $request->input('photo');
        $player->club_id = $request->input('club_id');
        $player->position_id = $request->input('position_id');

        $player->save();

        return response()->json([
            "message" => "OK"
        ]);
    }

    public function showPlayerStats(int $id)
    {
        $player = Player::find($id);

        if ($player === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ])->setStatusCode(404);
        }

        $playerStats = PlayerStatsDTO::fromModel($player);
        $club = $player->club;
        $clubInfo = ClubPlayerDTO::fromModel($club);
        $position = $player->position->name;

        return response()->json([
            'player_stats' => $playerStats,
            'club_info' => $clubInfo,
            'position' => $position
        ]);
    }
}
