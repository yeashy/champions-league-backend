<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClubCrudController extends Controller
{
    public function read($id)
    {
        $club = Club::find($id);

        if ($club === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ])->setStatusCode(404);
        }

        return response()->json([
            "club" => $club
        ]);
    }

    public function create(Request $request)
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

        $club = new Club();

        $club->name = $request->input('name');
        $club->logo = $request->input('logo');
        $club->group_id = $request->input('group_id');
        $club->pot_id = $request->input('pot_id');
        $club->save();

        return response()->json([
            "message" => "OK"
        ]);
    }

    public function update($id, Request $request)
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

        $club->name = $request->input('name') ?? $club->name;
        $club->logo = $request->input('name') ?? $club->logo;

        return response()->json([
            "message" => "OK"
        ]);
    }

    public function delete($id)
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
