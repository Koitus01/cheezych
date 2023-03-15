<?php

namespace App\Domain\Enums;

enum GameResult: string
{
    case WHITE_WIN = 'white_win';
    case BLACK_WIN = 'black_win';
    case DRAW = 'draw';
    case ABANDONED = 'abandoned';
}
