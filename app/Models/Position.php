<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $amplua
 * @property string $name
 */
class Position extends Model
{
    use HasFactory;

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'formations_positions', 'position_id', 'formation_id');
    }
}
