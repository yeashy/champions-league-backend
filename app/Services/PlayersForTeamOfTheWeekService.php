<?php

namespace App\Services;

use App\Enums\Positions as P;
use App\Models\DTO\PlayerPositionDTO;
use App\Models\Position;

class PlayersForTeamOfTheWeekService
{
    public function getPlayersByPositions(string $positionName): array
    {
        $players = [];
        $positions = $this->getPositions($positionName);

        foreach ($positions as $position) {
            $playersFromDb = Position::where('name', 'like', $position)->first()
                ->players()
                ->whereNotNull('current_rate')
                ->where('current_rate', '>', 6.00)
                ->orderBy('current_rate', 'DESC')
                ->limit(20)
                ->get();

            $resultPlayers = $playersFromDb->map(function ($player) {
                return PlayerPositionDTO::fromModel($player);
            });

            $players[$position] = $resultPlayers;
        }

        return $players;
    }

    private function getPositions(string $name): array
    {
        return match ($name) {
            P::GK => [P::GK],
            P::LB => [P::LB, P::LWB, P::RB, P::RWB, P::CB],
            P::RB => [P::RB, P::RWB, P::LB, P::LWB, P::CB],
            P::LWB => [P::LWB, P::LB, P::RWB, P::RB, P::LM, P::RM, P::LW, P::RW],
            P::RWB => [P::RWB, P::RB, P::LWB, P::LB, P::RM, P::LM, P::RW, P::LW],
            P::CB => [P::CB, P::LB, P::RB, P::CDM, P::RWB, P::LWB, P::CM],
            P::CDM => [P::CDM, P::CM, P::CB, P::LB, P::RB, P::CAM, P::LWB, P::RWB],
            P::CM => [P::CM, P::CDM, P::CAM, P::RM, P::LM, P::RB, P::LB, P::CB],
            P::LM => [P::LM, P::LW, P::LF, P::RM, P::RW, P::RF, P::CM, P::CAM, P::LWB, P::RWB, P::LB, P::RB],
            P::RM => [P::RM, P::RW, P::RF, P::LM, P::LW, P::LF, P::CM, P::CAM, P::RWB, P::LWB, P::RB, P::LB],
            P::CAM => [P::CAM, P::CM, P::CF, P::LM, P::RM, P::LW, P::RW, P::LF, P::RF, P::ST],
            P::LW => [P::LW, P::LM, P::LF, P::RW, P::RM, P::RF, P::CF, P::CAM, P::ST],
            P::RW => [P::RW, P::RM, P::RF, P::LW, P::LM, P::LF, P::CF, P::CAM, P::ST],
            P::LF => [P::LF, P::LW, P::LM, P::RF, P::RW, P::RM, P::CF, P::CAM, P::ST],
            P::RF => [P::RF, P::RW, P::RM, P::LF, P::LW, P::LM, P::CF, P::CAM, P::ST],
            P::CF => [P::CF, P::ST, P::CAM, P::LF, P::RF, P::LW, P::RW, P::LM, P::RM, P::CM],
            P::ST => [P::ST, P::CF, P::LW, P::RW, P::CAM, P::RM, P::RM],
            default => []
        };
    }
}
