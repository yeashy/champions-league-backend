<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class NumOfClubs extends Enum
{
    const Group = 32;
    const FirstRound = 16;
    const QuaterFinal = 8;
    const SemiFinal = 4;
    const Final = 2;
    const Winner = 1;
}
