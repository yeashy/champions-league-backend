<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Group;

class ResultsRecalculationService
{
    public function recalculate(Game $game): void
    {
        $this->recalculateGroupResults($game->group);
    }

    private function recalculateGroupResults(Group $group): void
    {
        $clubs = $group
            ->clubs()
            ->orderBy('points', 'DESC')
            ->orderBy('goal_difference', 'DESC')
            ->orderBy('goals_scored', 'DESC')
            ->orderBy('name', 'ASC')
            ->get();

        for ($i = 0; $i < 3; $i++) {
            if ($clubs[$i]->points === $clubs[$i + 1]->points) {
                if ($this->count2MatchWinner($clubs[$i], $clubs[$i + 1]) === 2) {
                    $tmp = $clubs[$i + 1];
                    $clubs[$i + 1] = $clubs[$i];
                    $clubs[$i] = $tmp;
                }
            }
        }

        $place = 0;
        foreach ($clubs as $club) {
            $club->group_place = ++$place;
            $club->save();
        }
    }

    private function count2MatchWinner($club1, $club2)
    {
        $games = Game::where([
            ['home_club_id', '=', $club1->id],
            ['away_club_id', '=', $club2->id]
        ])
            ->orWhere([
                ['home_club_id', '=', $club2->id],
                ['away_club_id', '=', $club1->id]
            ])
            ->get();

        $g1 = 0;
        $g2 = 0;

        foreach ($games as $game) {
            $g1 += $game->home_club_id == $club1->id ? $game->home_scored : $game->away_scored;
            $g2 += $game->home_club_id == $club2->id ? $game->home_scored : $game->away_scored;
        }

        return $g1 >= $g2 ? 1 : 2;
    }
}
