<?php

namespace App\Domain\Entity\Pieces;

use App\Domain\DTO\MovementCoordinatesDTO;

class King extends AbstractPiece
{

    public function isValidMovement(MovementCoordinatesDTO $coordinates): bool
    {
        if (abs($coordinates->yTo - $coordinates->yFrom) > 1) {
            return false;
        }

        if (abs($coordinates->xTo - $coordinates->xFrom) > 1) {
            return false;
        }

        return true;
    }
}