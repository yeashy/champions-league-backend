<?php

namespace App\Http\Controllers;

use App\Enums\Ampluas;
use App\Enums\SortTypes;
use App\Models\DTO\ClubPlayerDTO;
use App\Models\DTO\PlayerStatsDTO;
use App\Models\DTO\VideoDTO;
use App\Models\Player;
use App\Models\Position;
use App\Services\PlayersForTeamOfTheWeekService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class PlayerController extends Controller
{
    public function showPlayerStats(int $id): JsonResponse
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
        $history = $player->history();

        return response()->json([
            'player_stats' => $playerStats,
            'club_info' => $clubInfo,
            'history' => $history
        ]);
    }

    public function swap(Request $request): JsonResponse
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

    public function sortBy(Request $request): JsonResponse
    {
        $sortType = $request->query('sort_type');

        if (!in_array($sortType, SortTypes::Players)) {
            return response()->json([
                "message" => "sort_type is invalid $sortType"
            ]);
        }

        $players = Player::select('club_id', 'position_id', 'name', 'surname', 'photo', $sortType)->orderBy($sortType, "DESC")->limit(20)->get();

        $result = [];

        if ($sortType === SortTypes::Players['clean_sheets']) {
            $players = $players->map(function ($player) {
                if ($player->position->amplua === Ampluas::Goalkeeper) {
                    return $player;
                }
            });
        }

        foreach ($players as $player) {
            if ($player !== null) {
                $result[] = [
                    "name" => $player->name,
                    "surname" => $player->surname,
                    "photo" => $player->photo,
                    "$sortType" => $player->$sortType,
                    "club_logo" => $player->club->logo
                ];
            }
        }

        return response()->json($result);
    }

    public function getForTeamOfTheWeek(Request $request, PlayersForTeamOfTheWeekService $playersForTeamOfTheWeekService): JsonResponse
    {
        $validatior = Validator::make($request->all(), [
            "position_id" => 'required|int|exists:positions,id'
        ]);

        if ($validatior->fails()) {
            return response()->json([
                "message" => $validator->errors()->all()
            ], 400);
        }

        $positionId = $request->input('position_id');

        $position = Position::find($positionId);

        $players = $playersForTeamOfTheWeekService->getPlayersByPositions($position->name);

        return response()->json($players);
    }
}
