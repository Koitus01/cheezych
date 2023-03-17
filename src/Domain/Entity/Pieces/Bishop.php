<?php

namespace App\Domain\Entity\Pieces;

class Bishop extends AbstractPiece
{

    public function isValidMovement(int $yFrom, int $xFrom, int $yTo, int $xTo): bool
    {
        if ($yFrom === $yTo) {
            return false;
        }

        if ($xFrom === $xTo) {
            return false;
        }

        if (abs($yFrom - $yTo) !== abs($xFrom - $xTo)) {
            return false;
        }

        return true;
    }

    public function isValidCapture(int $yFrom, int $xFrom, int $yTo, int $xTo): bool
    {
        // TODO: Implement isValidCapture() method.
    }
}