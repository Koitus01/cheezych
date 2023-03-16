<?php

namespace App\Domain\Entity;

use App\Domain\Config\BoardConfig;
use App\Domain\Entity\Pieces\Bishop;
use App\Domain\Entity\Pieces\King;
use App\Domain\Entity\Pieces\Knight;
use App\Domain\Entity\Pieces\Pawn;
use App\Domain\Entity\Pieces\Queen;
use App\Domain\Entity\Pieces\Rook;
use App\Domain\Enums\Side;
use App\Domain\Exceptions\UnknownXCoordinateException;
use App\Domain\Exceptions\UnknownYCoordinateException;
use Exception;

class Board
{
    /**
     * TODO: подумать, чтобы это был не массив
     * @var Square[] Spot
     */
    private array $squares = [];

    /**
     * @throws Exception
     */
    public function getSquare(int $y, int $x): Square
    {
        if (!isset($this->squares[$y])) {
            throw new UnknownYCoordinateException;
        }

        if (!isset($this->squares[$y][$x])) {
            throw new UnknownXCoordinateException;
        }

        return $this->squares[$y][$x];
    }

    public function getSquares(): array
    {
        return $this->squares;
    }
    public function reset()
    {
        $this->squares = [];

        #создаем поля с белыми
        $this->squares[BoardConfig::MIN_COORDINATE][1] = Square::create(1, 1, new Rook(Side::WHITE));
        $this->squares[BoardConfig::MIN_COORDINATE][2] = Square::create(1, 2, new Knight(Side::WHITE));
        $this->squares[BoardConfig::MIN_COORDINATE][3] = Square::create(1, 3, new Bishop(Side::WHITE));
        $this->squares[BoardConfig::MIN_COORDINATE][4] = Square::create(1, 4, new Queen(Side::WHITE));
        $this->squares[BoardConfig::MIN_COORDINATE][5] = Square::create(1, 5, new King(Side::WHITE));
        $this->squares[BoardConfig::MIN_COORDINATE][6] = Square::create(1, 6, new Bishop(Side::WHITE));
        $this->squares[BoardConfig::MIN_COORDINATE][7] = Square::create(1, 7, new Knight(Side::WHITE));
        $this->squares[BoardConfig::MIN_COORDINATE][8] = Square::create(1, 8, new Rook(Side::WHITE));
        for ($i = 1; $i <= 8; $i++) {
            $this->squares[2][$i] = Square::create(2, $i, new Pawn(Side::WHITE));
        }

        #создаем поля с черными
        $this->squares[BoardConfig::MAX_COORDINATE][1] = Square::create(1, 1, new Rook(Side::BLACK));
        $this->squares[BoardConfig::MAX_COORDINATE][2] = Square::create(1, 2, new Knight(Side::BLACK));
        $this->squares[BoardConfig::MAX_COORDINATE][3] = Square::create(1, 3, new Bishop(Side::BLACK));
        $this->squares[BoardConfig::MAX_COORDINATE][4] = Square::create(1, 4, new Queen(Side::BLACK));
        $this->squares[BoardConfig::MAX_COORDINATE][5] = Square::create(1, 5, new King(Side::BLACK));
        $this->squares[BoardConfig::MAX_COORDINATE][6] = Square::create(1, 6, new Bishop(Side::BLACK));
        $this->squares[BoardConfig::MAX_COORDINATE][7] = Square::create(1, 7, new Knight(Side::BLACK));
        $this->squares[BoardConfig::MAX_COORDINATE][8] = Square::create(1, 8, new Rook(Side::BLACK));
        for ($i = 1; $i <= 8; $i++) {
            $this->squares[7][$i] = Square::create(2, $i, new Pawn(Side::BLACK));
        }

        #создаем пустые поля
        for ($i = 3; $i <= 6; $i++) {
            for ($j= 1; $j <= 8; $j++) {
                $this->squares[$i][$j] = Square::create($i, $j);
            }
        }

        return $this->squares;
    }

}