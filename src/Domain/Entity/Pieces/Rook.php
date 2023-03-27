<?php

namespace App\Domain\Entity\Pieces;

use App\Domain\DTO\MovementCoordinatesDTO;
use App\Domain\Enums\PieceName;

class Rook extends AbstractPiece
{
    protected PieceName $name = PieceName::ROOK;

    public function isValidMovement(MovementCoordinatesDTO $coordinates): bool
    {
        # the rook cannot move diagonally
        if ($coordinates->yFrom !== $coordinates->yTo && $coordinates->xFrom !== $coordinates->xTo) {
            return false;
        }

        return true;
    }
}