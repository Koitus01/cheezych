<?php

namespace App\Domain\Entity\Pieces;

use App\Domain\Enums\PieceName;
use App\Domain\Enums\Side;

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

    abstract public function isValidMovement(int $yFrom, int $xFrom, int $yTo, int $xTo);

    abstract public function getCapturePattern();
}