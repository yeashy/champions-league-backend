<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface interfaceDTO
{
    public static function fromModel(Model $model);

    public static function fromRequest(Request $request);
}