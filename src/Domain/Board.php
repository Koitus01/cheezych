<?php

namespace App\Domain;

use App\Domain\Exceptions\UnknownXCoordinateException;
use App\Domain\Exceptions\UnknownYCoordinateException;
use App\Domain\Pieces\Pawn;
use App\Tests\Unit\Pieces\Bishop;
use Exception;

class Board
{
    /**
     * @var Square[] Spot
     */
    private array $squares;

    /**
     * @throws Exception
     */
    public function getSquare(int $y, int $x): Square
    {
        if (!isset($this->squares[$y])) {
            throw new UnknownYCoordinateException;
        }

        if (!isset($this->squares[$y][$x])) {
            throw new UnknownXCoordinateException('Unknown x coordinate');
        }

        return $this->squares[$y][$x];
    }

    public function getSquares(): array
    {
        return $this->squares;
    }
    public function reset()
    {
        $this->squares[1][1] = Square::create(1, 1, new Rook());
        $this->squares[1][2] = Square::create(1, 2, new Knight());
        $this->squares[1][3] = Square::create(1, 3, new Bishop());
        $this->squares[1][4] = Square::create(1, 4, new Queen());
        $this->squares[1][5] = Square::create(1, 5, new King());
        $this->squares[1][6] = Square::create(1, 6, new Bishop());
        $this->squares[1][7] = Square::create(1, 7, new Knight());
        $this->squares[1][8] = Square::create(1, 8, new Rook());

        for ($i = 1; $i <= 8; $i++) {
            $this->squares[2][$i] = Square::create(2, $i, new Pawn());
        }

        for ($i = 3; $i <= 8; $i++) {
            $this->squares[2][$i] = Square::create(2, $i, new Pawn());
        }


        return $this;
    }

}