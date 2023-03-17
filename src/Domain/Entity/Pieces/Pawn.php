<?php

namespace App\Domain\Entity\Pieces;

use App\Domain\DTO\MovementCoordinatesDTO;
use App\Domain\Enums\PieceName;
use App\Domain\Enums\Side;

class Pawn extends AbstractPiece
{
    protected PieceName $name = PieceName::PAWN;

    const BEGIN_Y_COORDINATES_MAP = [
        Side::WHITE->name => 2,
        Side::BLACK->name => 7
    ];

    public function isValidMovement(MovementCoordinatesDTO $coordinates): bool
    {
        #can only move forward
        if ($coordinates->xFrom !== $coordinates->xTo) {
            return false;
        }

        $beginCoordinates = self::BEGIN_Y_COORDINATES_MAP[$this->side->name];
        if (abs($coordinates->yTo - $coordinates->yFrom) >= 2 && $coordinates->yFrom !== $beginCoordinates) {
            return false;
        }

        #cannot move backward
        if ($this->side === Side::WHITE && $coordinates->yFrom > $coordinates->yTo) {
            return false;
        }
        if ($this->side === Side::BLACK && $coordinates->yFrom < $coordinates->yTo) {
            return false;
        }

        return true;
    }

    public function isValidCapture(MovementCoordinatesDTO $coordinates): bool
    {
        $xDiff = abs($coordinates->xFrom - $coordinates->xTo);
        $yDiff = $coordinates->yTo - $coordinates->yFrom;
        if ($this->side === Side::WHITE && $yDiff === 1 && $xDiff === 1) {
            return true;
        }

        if ($this->side === Side::BLACK && $yDiff === -1 && $xDiff === 1) {
            return true;
        }

        return false;
    }
}