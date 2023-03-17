<?php

namespace App\Domain\Entity\Pieces;

class Knight extends AbstractPiece
{

    public function isValidMovement(int $yFrom, int $xFrom, int $yTo, int $xTo): bool
    {
        if ($yFrom === $yTo || $xFrom === $xTo) {
            return false;
        }

        if (abs($yFrom - $yTo) !== 2 && abs($xFrom - $xTo) !== 2) {
            return false;
        }

        if (abs($yFrom - $yTo) === 2 && abs($xFrom - $xTo) !== 1) {
            return false;
        }

        if (abs($xFrom - $xTo) === 2 && abs($yFrom - $yTo) !== 1) {
            return false;
        }

        return true;
    }

    public function isValidCapture(int $yFrom, int $xFrom, int $yTo, int $xTo): bool
    {
        // TODO: Implement isValidCapture() method.
    }
}