<?php

namespace App\Http\Controllers;

use App\Models\DTO\ClubPlayerDTO;
use App\Models\DTO\PlayerStatsDTO;
use App\Models\Player;

class PlayerController extends Controller
{
    public function showPlayerStats(int $id)
    {
        $player = Player::find($id);

        if ($player === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ], 404);
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
