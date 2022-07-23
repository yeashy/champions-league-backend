<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamOfTheWeek extends Model
{
    use HasFactory;

    public function stage()
    {
        return $this->hasOne(Stage::class);
    }

    public function players()
    {
        return $this->belongsToMany(Player::class, 'player_team_of_the_week', 'team_of_the_week_id', 'player_id');
    }
}
