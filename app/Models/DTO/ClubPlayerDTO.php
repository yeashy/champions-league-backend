<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClubPlayerDTO implements interfaceDTO
{
    public string $name;
    public string $logo;

    public static function fromModel(Model $club)
    {
        return [
            "name" => $club->name,
            "logo" => $club->logo
        ];
    }

    public static function fromRequest(Request $request)
    {
        
    }
}