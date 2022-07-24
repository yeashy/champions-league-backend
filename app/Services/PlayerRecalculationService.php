<?php

namespace App\Services;

use App\Models\Player;

class PlayerRecalculationService
{
    public function recalculate(Player $player, int|null $goals, int|null $assists, int|null $own_goals, float|null $current_rate)
    {
        $club = $player->club;

        if ($goals !== null) {
            $diff = $goals - $player->goals;
            $club->goals_scored += $diff;
            $player->goals = $goals;
        }

        if ($assists !== null) {
            $diff = $assists - $player->assists;
            $club->goals_scored += $diff;
            $player->assists = $assists;
        }

        if ($own_goals !== null) {
            $diff = $own_goals - $player->own_goals;
            $club->goals_conceded += $diff;
            $player->own_goals = $own_goals;
        }

        if ($current_rate !== null) {
            $fullrate = $player->avg_rate * $player->games;
            $fullrate = $fullrate - $player->current_rate + $current_rate;
            $player->avg_rate = $fullrate / $player->games;
        }

        $player->save();
        $club->save();

        return true;
    }
}
