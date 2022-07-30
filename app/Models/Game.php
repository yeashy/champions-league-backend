<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function homeClub()
    {
        return $this->hasOne(Club::class, 'home_club_id');
    }

    public function awayClub()
    {
        return $this->hasOne(Club::class, 'away_club_id');
    }

    public function winner()
    {
        return $this->hasOne(Club::class, 'winner_club_id');
    }

    public function loser()
    {
        return $this->hasOne(Club::class, 'loser_club_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
