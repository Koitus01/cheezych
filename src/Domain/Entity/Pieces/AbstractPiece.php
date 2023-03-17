<?php

namespace App\Domain\Entity\Pieces;

use App\Domain\Enums\PieceName;
use App\Domain\Enums\Side;

abstract class AbstractPiece
{
    private readonly Side $side;
    protected PieceName $name = PieceName::KNIGHT;

    /**
     * @param Side $side
     */
    public function __construct(Side $side = Side::WHITE)
    {
        $this->side = $side;
    }

    public function getName(): PieceName
    {
        return $this->name;
    }

    /**
     * @return Side
     */
    public function getSide(): Side
    {
        return $this->side;
    }

    public function isWhite(): bool
    {
        return $this->side === Side::WHITE;
    }

    public function isBlack(): bool
    {
        return $this->side === Side::BLACK;
    }

    /**
     * TODO: pass DTO?
     * @param int $yFrom
     * @param int $xFrom
     * @param int $yTo
     * @param int $xTo
     * @return bool
     */
    abstract public function isValidMovement(int $yFrom, int $xFrom, int $yTo, int $xTo): bool;

    /**
     * The pawn has different movement and capture patterns
     * @param int $yFrom
     * @param int $xFrom
     * @param int $yTo
     * @param int $xTo
     * @return bool
     */
    public function isValidCapture(int $yFrom, int $xFrom, int $yTo, int $xTo): bool
    {
        return $this->isValidMovement($yFrom, $xFrom, $yTo, $xTo);
    }
}