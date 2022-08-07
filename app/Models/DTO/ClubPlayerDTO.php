<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClubPlayerDTO implements interfaceDTO
{
    private string $name;
    private string $logo;

    public static function fromModel(Model $club)
    {
        return [
            "id" => $club->id,
            "name" => $club->name,
            "logo" => $club->logo
        ];
    }

    public static function fromRequest(Request $request)
    {

    }
}
