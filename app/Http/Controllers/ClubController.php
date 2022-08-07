<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\DTO\PlayerStatsDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class ClubController extends Controller
{
    public function swapGroups(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            "club1" => 'int|required|exists:clubs,id',
            "club2" => 'int|required|exists:clubs,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->all()
            ], 400);
        }

        $clubs = Club::select('id', 'group_id')
            ->where('id', '=', $request->input('club1'))
            ->orWhere('id', '=', $request->input('club2'))
            ->get();


        if ($clubs[0]->group_id === $clubs[1]->group_id) {
            return response()->json([
                "message" => "Incorrect swap"
            ], 400);
        }

        $clubs[0]->group_id ^= $clubs[1]->group_id ^= $clubs[0]->group_id ^= $clubs[1]->group_id;
        $clubs[0]->save();
        $clubs[1]->save();

        return response()->json([
            "message" => "OK"
        ]);
    }

    public function swapPots(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            "club1" => 'int|required|exists:clubs,id',
            "club2" => 'int|required|exists:clubs,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->all()
            ], 400);
        }

        $clubs = Club::select('id', 'pot_id')
            ->where('id', '=', $request->input('club1'))
            ->orWhere('id', '=', $request->input('club2'))
            ->get();


        if ($clubs[0]->pot_id === $clubs[1]->pot_id) {
            return response()->json([
                "message" => "Incorrect swap"
            ], 400);
        }

        $clubs[0]->pot_id ^= $clubs[1]->pot_id ^= $clubs[0]->pot_id ^= $clubs[1]->pot_id;
        $clubs[0]->save();
        $clubs[1]->save();

        return response()->json([
            "message" => "OK"
        ]);
    }

    public function getPlayers(int $id): JsonResponse
    {
        $club = Club::find($id);

        if ($club === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ])->setStatusCode(404);
        }

        $players = $club->players;

        $result = $players->map(function ($player) {
            return PlayerStatsDTO::fromModel($player);
        });

        return response()->json($result);
    }
}
