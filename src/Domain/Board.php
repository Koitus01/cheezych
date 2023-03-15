<?php

namespace App\Domain;

use App\Domain\Config\BoardConfig;
use App\Domain\Enums\Color;
use App\Domain\Exceptions\UnknownXCoordinateException;
use App\Domain\Exceptions\UnknownYCoordinateException;
use App\Domain\Pieces\Bishop;
use App\Domain\Pieces\King;
use App\Domain\Pieces\Knight;
use App\Domain\Pieces\Pawn;
use App\Domain\Pieces\Queen;
use App\Domain\Pieces\Rook;
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
        $this->squares[BoardConfig::MIN_COORDINATE][1] = Square::create(1, 1, new Rook(Color::WHITE));
        $this->squares[BoardConfig::MIN_COORDINATE][2] = Square::create(1, 2, new Knight(Color::WHITE));
        $this->squares[BoardConfig::MIN_COORDINATE][3] = Square::create(1, 3, new Bishop(Color::WHITE));
        $this->squares[BoardConfig::MIN_COORDINATE][4] = Square::create(1, 4, new Queen(Color::WHITE));
        $this->squares[BoardConfig::MIN_COORDINATE][5] = Square::create(1, 5, new King(Color::WHITE));
        $this->squares[BoardConfig::MIN_COORDINATE][6] = Square::create(1, 6, new Bishop(Color::WHITE));
        $this->squares[BoardConfig::MIN_COORDINATE][7] = Square::create(1, 7, new Knight(Color::WHITE));
        $this->squares[BoardConfig::MIN_COORDINATE][8] = Square::create(1, 8, new Rook(Color::WHITE));
        for ($i = 1; $i <= 8; $i++) {
            $this->squares[2][$i] = Square::create(2, $i, new Pawn(Color::WHITE));
        }

        #создаем поля с черными
        $this->squares[BoardConfig::MAX_COORDINATE][1] = Square::create(1, 1, new Rook(Color::BLACK));
        $this->squares[BoardConfig::MAX_COORDINATE][2] = Square::create(1, 2, new Knight(Color::BLACK));
        $this->squares[BoardConfig::MAX_COORDINATE][3] = Square::create(1, 3, new Bishop(Color::BLACK));
        $this->squares[BoardConfig::MAX_COORDINATE][4] = Square::create(1, 4, new Queen(Color::BLACK));
        $this->squares[BoardConfig::MAX_COORDINATE][5] = Square::create(1, 5, new King(Color::BLACK));
        $this->squares[BoardConfig::MAX_COORDINATE][6] = Square::create(1, 6, new Bishop(Color::BLACK));
        $this->squares[BoardConfig::MAX_COORDINATE][7] = Square::create(1, 7, new Knight(Color::BLACK));
        $this->squares[BoardConfig::MAX_COORDINATE][8] = Square::create(1, 8, new Rook(Color::BLACK));
        for ($i = 1; $i <= 8; $i++) {
            $this->squares[7][$i] = Square::create(2, $i, new Pawn(Color::BLACK));
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