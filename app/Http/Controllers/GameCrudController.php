<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameCrudController extends Controller
{
    public function read($id)
    {
        $game = Game::find($id);

        if ($game === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ], 404);
        }
//TODO: make clubs and players info
        return response()->json([
            "game" => $game
        ]);
    }
}
