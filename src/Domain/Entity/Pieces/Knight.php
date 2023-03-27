<?php

namespace App\Domain\Entity\Pieces;

use App\Domain\DTO\MovementCoordinatesDTO;
use App\Domain\Enums\PieceName;

class Knight extends AbstractPiece
{
    protected PieceName $name = PieceName::KNIGHT;

    public function isValidMovement(MovementCoordinatesDTO $coordinates): bool
    {
        if ($coordinates->yFrom === $coordinates->yTo || $coordinates->xFrom === $coordinates->xTo) {
            return false;
        }

        if (abs($coordinates->yFrom - $coordinates->yTo) !== 2 &&
            abs($coordinates->xFrom - $coordinates->xTo) !== 2) {
            return false;
        }

        if (abs($coordinates->yFrom - $coordinates->yTo) === 2 &&
            abs($coordinates->xFrom - $coordinates->xTo) !== 1) {
            return false;
        }

        if (abs($coordinates->xFrom - $coordinates->xTo) === 2 &&
            abs($coordinates->yFrom - $coordinates->yTo) !== 1) {
            return false;
        }

        return true;
    }
}