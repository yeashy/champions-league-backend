<?php

namespace App\Http\Controllers;

use App\Models\DTO\ClubPlayerDTO;
use App\Models\DTO\PlayerStatsDTO;
use App\Models\DTO\VideoDTO;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function React\Promise\map;

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
        $history = $player->history();

        $videos = $player->videos->map(function ($video) {
            return VideoDTO::fromModel($video);
        });

        return response()->json([
            'player_stats' => $playerStats,
            'club_info' => $clubInfo,
            'position' => $position,
            'videos' => $videos,
            'history' => $history
        ]);
    }

    public function swap(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "player1" => 'int|required|exists:players,id',
            "player2" => 'int|required|exists:players,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->all()
            ], 400);
        }

        $players = Player::select('id', 'club_id', 'is_default_in_squad')
            ->where('id', '=', $request->input('player1'))
            ->orWhere('id', '=', $request->input('player2'))
            ->get();


        if ($players[0]->club_id !== $players[1]->club_id || $players[0]->is_default_in_squad === $players[1]->is_default_in_squad) {
            return response()->json([
                "message" => "Incorrect swap"
            ], 400);
        }

        $players[0]->is_default_in_squad = !$players[0]->is_default_in_squad;
        $players[1]->is_default_in_squad = !$players[1]->is_default_in_squad;
        $players[0]->save();
        $players[1]->save();

        return response()->json([
            "message" => "OK"
        ]);
    }
}
