<?php

namespace App\Http\Controllers;

use App\Models\DTO\PlayerDTO;
use Illuminate\Http\Request;
use App\Models\DTO\ClubPlayerDTO;
use App\Models\Player;
use App\Services\PlayerRecalculationService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class PlayerCrudController extends Controller
{
    public function read(int $id): JsonResponse
    {
        $player = Player::find($id);

        if ($player === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ])->setStatusCode(404);
        }

        $club = ClubPlayerDTO::fromModel($player->club);
        $position = $player->position->name;

        return response()->json([
            "player" => $player
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'surname' => 'string|required',
            'photo' => 'string|required|unique:players',
            'club_id' => 'int|required|exists:clubs,id',
            'position_id' => 'int|required|exists:positions,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->all()
            ], 400);
        }

        $player = PlayerDTO::fromRequest($request);
        $player->save();

        return response()->json([
            "message" => "OK"
        ]);
    }

    public function update(int $id, Request $request, PlayerRecalculationService $playerRecalculationService): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'surname' => 'string',
            'photo' => 'string|unique:players',
            'club_id' => 'int|exists:clubs,id',
            'position_id' => 'int|exists:positions,id',
            'avg_rate' => 'float|max:10|min:0',
            'goals' => 'int|min:0',
            'assists' => 'int|min:0',
            'yellow_cards' => 'int|min:0|max:13',
            'red_cards' => 'int|min:0|max:13',
            'current_rate' => 'float|max:10|min:0',
            'own_goals' => 'int|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->all()
            ], 400);
        }

        $player = Player::find($id);

        if ($player === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ])->setStatusCode(404);
        }

        $player->name = $request->input('name') ?? $player->name;
        $player->surname = $request->input('surname') ?? $player->surname;
        $player->photo = $request->input('photo') ?? $player->photo;
        $player->yellow_cards = $request->input('yellow_cards') ?? $player->yellow_cards;
        $player->red_cards = $request->input('red_cards') ?? $player->red_cards;
        $player->is_disqualified = $request->input('is_disqualified') ?? $player->is_disqualified;
        $player->club_id = $request->input('club_id') ?? $player->club_id;
        $player->position_id = $request->input('position_id') ?? $player->position_id;

        $playerRecalculationService->recalculate(
            $player,
            $request->input('goals'),
            $request->input('assists'),
            $request->input('own_goals'),
            $request->input('current_rate')
        );

        return response()->json([
            "message" => "OK"
        ]);
    }

    public function delete(int $id): JsonResponse
    {
        $player = Player::find($id);

        if ($player === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ])->setStatusCode(404);
        }

        $player->delete();

        return response()->json([
            "message" => "OK"
        ]);
    }

    //    TODO: make list with goals, assists, etc (by club done, by position)
}
