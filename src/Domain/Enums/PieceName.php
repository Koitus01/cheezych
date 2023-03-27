<?php

namespace App\Domain\Enums;

enum PieceName: string
{
    case BISHOP = 'bishop';
    case KING = 'king';
    case KNIGHT = 'knight';
    case PAWN = 'pawn';
    case QUEEN = 'queen';
    case ROOK = 'rook';
}
