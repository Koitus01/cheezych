<?php

namespace App\Domain\Entity\Pieces;

use App\Domain\Enums\PieceName;

class Pawn extends AbstractPiece
{
    protected PieceName $name = PieceName::PAWN;

    public function isValidMovement(int $yFrom, int $xFrom, int $yTo, int $xTo): bool
    {
        #the pawn can only move forward
        if ($xFrom !== $xTo) {
            return false;
        }

        if ($yTo - $yFrom >= 2 && $yFrom !== 2) {
            return false;
        }

        if ($yFrom > $yTo) {
            return false;
        }

        return true;
    }

    public function getCapturePattern()
    {
        // TODO: Implement getCapturePattern() method.
    }
}