<?php

namespace App\Domain\Entity\Pieces;

use App\Domain\DTO\MovementCoordinatesDTO;
use App\Domain\Enums\PieceName;

class Bishop extends AbstractPiece
{
    protected PieceName $name = PieceName::BISHOP;

    public function isValidMovement(MovementCoordinatesDTO $coordinates): bool
    {
        if ($coordinates->yFrom === $coordinates->yTo) {
            return false;
        }

        if ($coordinates->xFrom === $coordinates->xTo) {
            return false;
        }

        if (abs($coordinates->yFrom - $coordinates->yTo) !== abs($coordinates->xFrom - $coordinates->xTo)) {
            return false;
        }

        return true;
    }
}