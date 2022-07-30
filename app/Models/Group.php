<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $letter
 */
class Group extends Model
{
    use HasFactory;

    function clubs()
    {
        return $this->hasMany(Club::class);
    }

    function games()
    {
        return $this->hasMany(Game::class);
    }
}
