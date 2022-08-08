<?php

namespace App\Http\Controllers;

use App\Models\DTO\ClubPlayerDTO;
use App\Models\Pot;
use Illuminate\Http\JsonResponse;

class PotController extends Controller
{
    public function getClubs(): JsonResponse
    {
        $pots = Pot::all();

        $potsResults = [];

        foreach ($pots as $pot) {
            $clubs = $pot->clubs;

            $clubsResults = $clubs->map(function ($club) {
                return ClubPlayerDTO::fromModel($club);
            });

            $potsResults[$pot->id] = $clubsResults;
        }

        return response()->json($potsResults);
    }
}
