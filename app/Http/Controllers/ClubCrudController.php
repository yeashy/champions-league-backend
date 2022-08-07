<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\DTO\ClubDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class ClubCrudController extends Controller
{
    public function read(int $id): JsonResponse
    {
        $club = Club::find($id);

        if ($club === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ])->setStatusCode(404);
        }

        return response()->json($club);
    }

    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'logo' => 'string|required',
            'group_id' => 'int|required|exists:groups,id',
            'pot_id' => 'int|required|exists:pots,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->all()
            ], 400);
        }

        $club = ClubDTO::fromRequest($request);
        $club->save();

        return response()->json([
            "message" => "OK"
        ]);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'logo' => 'logo'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->all()
            ], 400);
        }

        $club = Club::find($id);

        if ($club === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ])->setStatusCode(404);
        }

        $club->name = $request->input('name') ?? $club->name;
        $club->logo = $request->input('name') ?? $club->logo;

        return response()->json([
            "message" => "OK"
        ]);
    }

    public function delete(int $id): JsonResponse
    {
        $club = Club::find($id);

        if ($club === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ])->setStatusCode(404);
        }

        $club->delete();

        return response()->json([
            "message" => "OK"
        ]);
    }

//    TODO: make list with scored, conceded, etc (by group, by pot, by is_playing)
}
