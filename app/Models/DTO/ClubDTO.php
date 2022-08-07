<?php

namespace App\Models\DTO;

use App\Models\Club;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClubDTO implements interfaceDTO
{

    public static function fromModel(Model $model)
    {

    }

    public static function fromRequest(Request $request)
    {
        $club = new Club();
        $club->name = $request->input('name');
        $club->logo = $request->input('logo');
        $club->group_id = $request->input('group_id');
        $club->pot_id = $request->input('pot_id');
        return $club;
    }
}
