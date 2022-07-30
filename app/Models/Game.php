<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property int $home_club_id
 * @property int $away_club_id
 * @property int $stage_id
 * @property int $group_id
 * @property int $id
 */
class Game extends Model
{
    use HasFactory;

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function homeClub()
    {
        return $this->belongsTo(Club::class, 'home_club_id');
    }

    public function awayClub()
    {
        return $this->belongsTo(Club::class, 'away_club_id');
    }

    public function winner()
    {
        return $this->belongsTo(Club::class, 'winner_club_id');
    }

    public function loser()
    {
        return $this->belongsTo(Club::class, 'loser_club_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function players()
    {
        $players = DB::table('games_users')->where('game_id', '=', $this->id);
    }
}
