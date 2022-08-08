<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class VideoDTO implements InterfaceDTO
{

    public static function fromModel(Model $video)
    {
        return [
            "id" => $video->id,
            "path" => $video->path
        ];
    }

    public static function fromRequest(Request $request)
    {

    }
}
