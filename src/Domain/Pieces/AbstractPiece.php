<?php

namespace App\Domain\Pieces;

use App\Domain\Enums\Side;
use App\Domain\Enums\PieceName;

abstract class AbstractPiece
{
    public readonly Side $color;
    protected PieceName $name;

    /**
     * @param Side $color
     */
    public function __construct(Side $color)
    {
        $this->color = $color;
    }

    public function getName(): PieceName
    {
        return $this->name;
    }

    public function isWhite(): bool
    {
        return $this->color === Side::WHITE;
    }

    public function isBlack(): bool
    {
        return $this->color === Side::BLACK;
    }

    abstract public function getMovementPattern();

    abstract public function getCapturePattern();
}