<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function teamsOfTheWeeks()
    {
        return $this->belongsToMany(TeamOfTheWeek::class, 'player_team_of_the_week', 'player_id', 'team_of_the_week_id');
    }
}
