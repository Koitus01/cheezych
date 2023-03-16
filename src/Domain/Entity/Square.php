<?php

namespace App\Domain\Entity;

use App\Domain\Config\BoardConfig;
use App\Domain\Entity\Pieces\AbstractPiece;

class Square
{
    public readonly int $x;
    public readonly int $y;
    private ?AbstractPiece $piece = null;

    /**
     * @param int $x
     * @param int $y
     */
    public function __construct(int $y, int $x)
    {
        $this->y = $y;
        $this->x = $x;
    }

    public function setPiece(?AbstractPiece $piece): static
    {
        $this->piece = $piece;
        return $this;
    }

    /**
     * @return AbstractPiece|null
     */
    public function getPiece(): ?AbstractPiece
    {
        return $this->piece;
    }

    static function create(int $y, int $x, ?AbstractPiece $piece = null): Square
    {
        return (new self($y, $x))->setPiece($piece);
    }
}