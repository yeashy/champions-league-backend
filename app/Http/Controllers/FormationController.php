<?php

namespace App\Http\Controllers;

use App\Models\DTO\FormationDTO;
use App\Models\DTO\PositionDTO;
use App\Models\Formation;
use Illuminate\Http\JsonResponse;

class FormationController extends Controller
{
    public function getFormations(): JsonResponse
    {
        $formations = Formation::all();

        $formationsResult = $formations->map(function ($formation) {
            return FormationDTO::fromModel($formation);
        });

        return response()->json($formationsResult);
    }

    public function getPositions(int $id): JsonResponse
    {
        $formation = Formation::find($id);

        if ($formation === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ], 404);
        }

        $positions = $formation->positions;

        $positionsResult = $positions->map(function ($position) {
            return PositionDTO::fromModel($position);
        });

        return response()->json($positionsResult);
    }
}
