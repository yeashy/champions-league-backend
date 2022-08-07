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
 * @property int $winner_club_id
 * @property int $loser_club_id
 * @property bool $has_played
 * @property Club $homeClub
 * @property Club $awayClub
 * @property int $home_scored
 * @property int $away_scored
 * @property Club $winner
 * @property Club $loser
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
        $players = DB::table('games_players')
            ->where('game_id', '=', $this->id)
            ->join('players', 'players.id', '=', 'games_players.player_id')
            ->select('games_players.*', 'players.name', 'players.surname', 'players.photo', 'players.position_id', 'players.club_id')
            ->get();

        return $players->map(function ($player) {
            return [
                "id" => $player->player_id,
                "goals" => $player->goals,
                "assists" => $player->assists,
                "own_goals" => $player->own_goals,
                "yellow_cards" => $player->yellow_cards,
                "red_cards" => $player->red_cards,
                "rate" => $player->rate,
                "name" => $player->name,
                "surname" => $player->surname,
                "photo" => $player->photo,
                "club_id" => $player->club_id
            ];
        });
    }
}
