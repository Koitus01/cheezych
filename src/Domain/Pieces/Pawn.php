<?php

namespace App\Domain\Pieces;

use App\Domain\Enums\PieceName;

class Pawn extends AbstractPiece
{
    protected PieceName $name = PieceName::PAWN;

    public function isValidMovement(int $yFrom, int $xFrom, int $yTo, int $xTo)
    {
        // TODO: Implement getMovementPattern() method.
    }

    public function getCapturePattern()
    {
        // TODO: Implement getCapturePattern() method.
    }
}