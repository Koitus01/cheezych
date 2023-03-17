<?php

namespace App\Domain\Entity\Pieces;

use App\Domain\DTO\MovementCoordinatesDTO;

class Queen extends AbstractPiece
{

    public function isValidMovement(MovementCoordinatesDTO $coordinates): bool
    {
        $yDiff = abs($coordinates->yFrom - $coordinates->yTo);
        $xDiff = abs($coordinates->xFrom - $coordinates->xTo);
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
}