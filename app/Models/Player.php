<?php

namespace App\Models;

use App\Models\DTO\ClubPlayerDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property string $name
 * @property string $surname
 * @property string $photo
 * @property int $club_id
 * @property int $position_id
 * @property int $id
 * @property int $goals
 * @property int $assists
 * @property int $own_goals
 * @property int $games
 * @property float $avg_rate
 * @property float $current_rate
 * @property Club $club
 * @property int $yellow_cards
 * @property int $red_cards
 */
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

    public function history()
    {
        $matches = DB::table('games_players')->where('player_id', '=', $this->id)->get();

        $clubs = $matches->map(function ($match) {
            $game = Game::find($match->game_id);

            if ($game->homeClub === $this->club) {
                return ClubPlayerDTO::fromModel($game->awayClub);
            }

            return ClubPlayerDTO::fromModel($game->homeClub);
        });

        $history = [];

        foreach ($matches as $index => $match) {
            $history[] = [
                "goals" => $match->goals,
                "assists" => $match->assists,
                "own_goals" => $match->own_goals,
                "yellow_cards" => $match->yellow_cards,
                "red_cards" => $match->red_cards,
                "rate" => $match->rate,
                "against" => $clubs[$index]
            ];
        }

        return $history;
    }
}
