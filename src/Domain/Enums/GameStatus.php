<?php

namespace App\Domain\Enums;

enum GameStatus: string
{
    case FINISHED = 'finished';
    case ACTIVE = 'active';
}
