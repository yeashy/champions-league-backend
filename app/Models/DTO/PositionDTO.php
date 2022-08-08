<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PositionDTO implements InterfaceDTO
{

    public static function fromModel(Model $position)
    {
        return [
            "id" => $position->id,
            "amplua" => $position->amplua,
            "name" => $position->name
        ];
    }

    public static function fromRequest(Request $request)
    {

    }
}
