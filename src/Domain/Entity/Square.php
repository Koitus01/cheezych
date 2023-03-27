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
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
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

    static function create(int $x, int $y, ?AbstractPiece $piece = null): Square
    {
        return (new self($x, $y))->setPiece($piece);
    }
}