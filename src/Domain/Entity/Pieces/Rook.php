<?php

namespace App\Domain\Entity\Pieces;

class Rook extends AbstractPiece
{

    public function isValidMovement(int $yFrom, int $xFrom, int $yTo, int $xTo): bool
    {
        # the rook cannot move diagonally
        if ($yFrom !== $yTo && $xFrom !== $xTo) {
            return false;
        }

        return true;
    }
}