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
     * TODO: make it not array??
     * @var Square[] Spot
     */
    private array $squares = [];

    /**
     * @throws UnknownYCoordinateException
     * @throws UnknownXCoordinateException
     */
    public function getSquare(int $x, int $y): Square
    {
        if (!isset($this->squares[$x])) {
            throw new UnknownXCoordinateException;
        }

        if (!isset($this->squares[$x][$y])) {
            throw new UnknownYCoordinateException;
        }

        return $this->squares[$x][$y];
    }

    public function getSquares(): array
    {
        return $this->squares;
    }

    public function reset(): array
    {
        $this->squares = [];

        #white pawns
        $this->squares[1][BoardConfig::MIN_COORDINATE] = Square::create(
            1,
            BoardConfig::MIN_COORDINATE,
            new Rook(Side::WHITE)
        );
        $this->squares[2][BoardConfig::MIN_COORDINATE] = Square::create(
            2,
            BoardConfig::MIN_COORDINATE,
            new Knight(Side::WHITE)
        );
        $this->squares[3][BoardConfig::MIN_COORDINATE] = Square::create(
            3,
            BoardConfig::MIN_COORDINATE,
            new Bishop(Side::WHITE)
        );
        $this->squares[4][BoardConfig::MIN_COORDINATE] = Square::create(
            4,
            BoardConfig::MIN_COORDINATE,
            new Queen(Side::WHITE)
        );
        $this->squares[5][BoardConfig::MIN_COORDINATE] = Square::create(
            5,
            BoardConfig::MIN_COORDINATE,
            new King(Side::WHITE)
        );
        $this->squares[6][BoardConfig::MIN_COORDINATE] = Square::create(
            6,
            BoardConfig::MIN_COORDINATE,
            new Bishop(Side::WHITE)
        );
        $this->squares[7][BoardConfig::MIN_COORDINATE] = Square::create(
            7,
            BoardConfig::MIN_COORDINATE,
            new Knight(Side::WHITE)
        );
        $this->squares[8][BoardConfig::MIN_COORDINATE] = Square::create(
            8,
            BoardConfig::MIN_COORDINATE,
            new Rook(Side::WHITE)
        );
        #white pawns
        for ($i = 1; $i <= 8; $i++) {
            $this->squares[$i][2] = Square::create($i, 2, new Pawn(Side::WHITE));
        }

        #black pieces
        $this->squares[1][BoardConfig::MAX_COORDINATE] = Square::create(
            1,
            BoardConfig::MAX_COORDINATE,
            new Rook(Side::BLACK)
        );
        $this->squares[2][BoardConfig::MAX_COORDINATE] = Square::create(
            2,
            BoardConfig::MAX_COORDINATE,
            new Knight(Side::BLACK)
        );
        $this->squares[3][BoardConfig::MAX_COORDINATE] = Square::create(
            3,
            BoardConfig::MAX_COORDINATE,
            new Bishop(Side::BLACK)
        );
        $this->squares[4][BoardConfig::MAX_COORDINATE] = Square::create(
            4,
            BoardConfig::MAX_COORDINATE,
            new Queen(Side::BLACK)
        );
        $this->squares[5][BoardConfig::MAX_COORDINATE] = Square::create(
            5,
            BoardConfig::MAX_COORDINATE,
            new King(Side::BLACK)
        );
        $this->squares[6][BoardConfig::MAX_COORDINATE] = Square::create(
            6,
            BoardConfig::MAX_COORDINATE,
            new Bishop(Side::BLACK)
        );
        $this->squares[7][BoardConfig::MAX_COORDINATE] = Square::create(
            7,
            BoardConfig::MAX_COORDINATE,
            new Knight(Side::BLACK)
        );
        $this->squares[8][BoardConfig::MAX_COORDINATE] = Square::create(
            8,
            BoardConfig::MAX_COORDINATE,
            new Rook(Side::BLACK)
        );
        #black pawns
        for ($i = 1; $i <= 8; $i++) {
            $this->squares[$i][7] = Square::create($i, 2, new Pawn(Side::BLACK));
        }

        #empty fields
        for ($x = BoardConfig::MIN_COORDINATE; $x <= BoardConfig::MAX_COORDINATE; $x++) {
            for ($j = 3; $j <= 6; $j++) {
                $this->squares[$x][$j] = Square::create($x, $j);
            }
        }

        return $this->squares;
    }

}