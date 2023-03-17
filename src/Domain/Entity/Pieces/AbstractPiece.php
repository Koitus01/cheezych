<?php

namespace App\Domain\Entity\Pieces;

use App\Domain\DTO\MovementCoordinatesDTO;
use App\Domain\Enums\PieceName;
use App\Domain\Enums\Side;

abstract class AbstractPiece
{
    protected readonly Side $side;
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
     * @param MovementCoordinatesDTO $coordinates
     * @return bool
     */
    abstract public function isValidMovement(MovementCoordinatesDTO $coordinates): bool;

    /**
     * The pawn has different movement and capture patterns
     * @param MovementCoordinatesDTO $coordinates
     * @return bool
     */
    public function isValidCapture(MovementCoordinatesDTO $coordinates): bool
    {
        return $this->isValidMovement($coordinates);
    }
}