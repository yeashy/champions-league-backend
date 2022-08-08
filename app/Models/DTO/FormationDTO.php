<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FormationDTO implements InterfaceDTO
{

    public static function fromModel(Model $formation)
    {
        return [
            "id" => $formation->id,
            "name" => $formation->name
        ];
    }

    public static function fromRequest(Request $request)
    {

    }
}
