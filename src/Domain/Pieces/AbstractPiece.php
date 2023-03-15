<?php

namespace App\Domain\Pieces;

use App\Domain\Enums\Color;
use App\Domain\Enums\PieceName;

abstract class AbstractPiece
{
    public readonly Color $color;
    protected PieceName $name;

    /**
     * @param Color $color
     */
    public function __construct(Color $color)
    {
        $this->color = $color;
    }

    public function getName(): PieceName
    {
        return $this->name;
    }

    public function isWhite(): bool
    {
        return $this->color === Color::WHITE;
    }

    public function isBlack(): bool
    {
        return $this->color === Color::BLACK;
    }

    abstract public function getMovementPattern();

    abstract public function getCapturePattern();
}