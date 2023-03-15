<?php

namespace App\Domain\Pieces;

use App\Domain\Enums\Color;

abstract class AbstractPiece
{
    public readonly Color $color;

    /**
     * @param Color $color
     */
    public function __construct(Color $color)
    {
        $this->color = $color;
    }

    public function isWhite()
    {
        return $this->color === Color::WHITE;
    }

    public function isBlack()
    {
        return $this->color === Color::BLACK;
    }


}