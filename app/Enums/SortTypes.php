<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SortTypes extends Enum
{
    const Players = [
        "goals" => "goals",
        "assists" => "assists",
        "yellow_cards" => "yellow_cards",
        "red_cards" => "red_cards",
        "clean_sheets" => "clean_sheets",
        "own_goals" => "own_goals",
        "avg_rate" => "avg_rate"
    ];
}
