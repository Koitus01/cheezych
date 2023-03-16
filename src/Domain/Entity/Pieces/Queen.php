<?php

namespace App\Domain\Entity\Pieces;

class Queen extends AbstractPiece
{

    public function isValidMovement(int $yFrom, int $xFrom, int $yTo, int $xTo): bool
    {
        $yDiff = abs($yFrom - $yTo);
        $xDiff = abs($xFrom - $xTo);
        #diagonal move
        if ($yDiff > 0 && $yDiff === $xDiff) {
            return true;
        }

        #horizontall move
        if ($yDiff === 0 && $xDiff > 0) {
            return true;
        }
        #vertical move
        if ($xDiff === 0 && $yDiff > 0) {
            return true;
        }

        return false;
    }

    public function getCapturePattern()
    {
        // TODO: Implement getCapturePattern() method.
    }
}