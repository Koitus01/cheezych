<?php

namespace App\Domain\Entity\Pieces;

use App\Domain\DTO\MovementCoordinatesDTO;

class Rook extends AbstractPiece
{

    public function isValidMovement(MovementCoordinatesDTO $coordinates): bool
    {
        # the rook cannot move diagonally
        if ($coordinates->yFrom !== $coordinates->yTo && $coordinates->xFrom !== $coordinates->xTo) {
            return false;
        }

        return true;
    }
}