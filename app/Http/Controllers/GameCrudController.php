<?php

namespace App\Http\Controllers;

use App\Models\DTO\ClubPlayerDTO;
use App\Models\DTO\GameDTO;
use App\Models\Game;
use App\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class GameCrudController extends Controller
{
    public function read(int $id): JsonResponse
    {
        $game = Game::find($id);

        if ($game === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ], 404);
        }

        $gameResult = GameDTO::fromModel($game);
        $homeClub = ClubPlayerDTO::fromModel($game->homeClub);
        $awayClub = ClubPlayerDTO::fromModel($game->awayClub);
        $players = $game->players();

        return response()->json([
            "game" => $gameResult,
            "home_club" => $homeClub,
            "away_club" => $awayClub,
            "players" => $players
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            "home_club_id" => 'int|required|exists:clubs,id',
            "away_club_id" => 'int|required|exists:clubs,id',
            "stage_id" => 'int|required|exists:stages,id',
            "group_id" => 'int|exists:groups,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->all()
            ], 400);
        }

        $game = GameDTO::fromRequest($request);
        $game->save();

        return response()->json([
            "message" => "OK"
        ]);
    }

    public function update(int $id, Request $request, GameService $gameService): JsonResponse
    {
        $game = Game::find($id);

        if ($game === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            "home_players" => 'array|required',
            "away_players" => 'array|required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->all()
            ], 400);
        }

        $game = $gameService->countAllResults($request->input('home_players'), $request->input('away_players'), $game);
        $game->save();
        //TODO: maybe recalculate group and stage results
        return response()->json([
            "message" => "OK"
        ]);
    }
}
