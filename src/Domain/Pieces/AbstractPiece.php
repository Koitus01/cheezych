<?php

namespace App\Domain\Pieces;

use App\Domain\Color;

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

    }


}