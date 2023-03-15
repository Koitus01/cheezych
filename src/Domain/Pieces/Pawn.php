<?php

namespace App\Domain\Pieces;

use App\Domain\Enums\PieceName;

class Pawn extends AbstractPiece
{
    protected PieceName $name = PieceName::PAWN;

    public function getMovementPattern()
    {
        // TODO: Implement getMovementPattern() method.
    }

    public function getCapturePattern()
    {
        // TODO: Implement getCapturePattern() method.
    }
}