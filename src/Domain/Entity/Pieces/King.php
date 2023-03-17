<?php

namespace App\Domain\Entity\Pieces;

class King extends AbstractPiece
{

    public function isValidMovement(int $yFrom, int $xFrom, int $yTo, int $xTo): bool
    {
        if ($yTo - $yFrom > 1) {
            return false;
        }

        if ($yFrom - $yTo > 1) {
            return false;
        }

        if ($xTo - $xFrom > 1) {
            return false;
        }

        if ($xFrom - $xTo > 1) {
            return false;
        }



        return true;
        // TODO: Implement getMovementPattern() method.
    }

    public function isValidCapture(int $yFrom, int $xFrom, int $yTo, int $xTo): bool
    {
        // TODO: Implement isValidCapture() method.
    }
}