<?php

namespace App\Http\Controllers;

use App\Models\DTO\ClubGroupDTO;
use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function getClubs(): JsonResponse
    {
        $groups = Group::all();

        $groupsResults = [];
        foreach ($groups as $group) {
            $clubs = $group->clubs;

            $clubsResults = $clubs->map(function ($club) {
                return ClubGroupDTO::fromModel($club);
            });

            $groupsResults[$group->letter] = $clubsResults;
        }

        return response()->json($groupsResults);
    }

    //TODO: add groups
}
