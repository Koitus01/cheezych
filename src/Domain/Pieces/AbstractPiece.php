<?php

namespace App\Domain\Pieces;

use App\Domain\Enums\Side;
use App\Domain\Enums\PieceName;

abstract class AbstractPiece
{
    public readonly Side $side;
    protected PieceName $name;

    /**
     * @param Side $side
     */
    public function __construct(Side $side)
    {
        $this->side = $side;
    }

    public function getName(): PieceName
    {
        return $this->name;
    }

    public function isWhite(): bool
    {
        return $this->side === Side::WHITE;
    }

    public function isBlack(): bool
    {
        return $this->side === Side::BLACK;
    }

    abstract public function getMovementPattern();

    abstract public function getCapturePattern();
}