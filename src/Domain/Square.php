<?php

namespace App\Domain;

use App\Domain\Config\BoardConfig;
use App\Domain\Pieces\AbstractPiece;

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
        if ($x < BoardConfig::MIN_COORDINATE || $x < BoardConfig::MAX_COORDINATE) {
        }

        if ($y < BoardConfig::MIN_COORDINATE || $y < BoardConfig::MAX_COORDINATE) {
        }
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

    static function create(int $y, int $x, ?AbstractPiece $piece = null): Square
    {
        return (new self($y, $x))->setPiece($piece);
    }
}