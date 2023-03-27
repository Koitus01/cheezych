<?php

namespace App\Tests\Unit\Domain\Entity;

use App\Domain\Config\BoardConfig;
use App\Domain\Entity\Board;
use App\Domain\Entity\Pieces\Bishop;
use App\Domain\Entity\Pieces\King;
use App\Domain\Entity\Pieces\Knight;
use App\Domain\Entity\Pieces\Pawn;
use App\Domain\Entity\Pieces\Queen;
use App\Domain\Entity\Pieces\Rook;
use App\Domain\Entity\Square;
use App\Domain\Enums\Side;
use App\Domain\Exceptions\UnknownXCoordinateException;
use App\Domain\Exceptions\UnknownYCoordinateException;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    public function testResetBoard()
    {
        $b = new Board();
        $resetResult = $b->reset();

        $expectedSquares[1][BoardConfig::MIN_COORDINATE] = Square::create(
            1,
            BoardConfig::MIN_COORDINATE,
            new Rook(Side::WHITE)
        );
        $expectedSquares[2][BoardConfig::MIN_COORDINATE] = Square::create(
            2,
            BoardConfig::MIN_COORDINATE,
            new Knight(Side::WHITE)
        );
        $expectedSquares[3][BoardConfig::MIN_COORDINATE] = Square::create(
            3,
            BoardConfig::MIN_COORDINATE,
            new Bishop(Side::WHITE)
        );
        $expectedSquares[4][BoardConfig::MIN_COORDINATE] = Square::create(
            4,
            BoardConfig::MIN_COORDINATE,
            new Queen(Side::WHITE)
        );
        $expectedSquares[5][BoardConfig::MIN_COORDINATE] = Square::create(
            5,
            BoardConfig::MIN_COORDINATE,
            new King(Side::WHITE)
        );
        $expectedSquares[6][BoardConfig::MIN_COORDINATE] = Square::create(
            6,
            BoardConfig::MIN_COORDINATE,
            new Bishop(Side::WHITE)
        );
        $expectedSquares[7][BoardConfig::MIN_COORDINATE] = Square::create(
            7,
            BoardConfig::MIN_COORDINATE,
            new Knight(Side::WHITE)
        );
        $expectedSquares[8][BoardConfig::MIN_COORDINATE] = Square::create(
            8,
            BoardConfig::MIN_COORDINATE,
            new Rook(Side::WHITE)
        );
        #white pawns
        for ($i = 1; $i <= 8; $i++) {
            $expectedSquares[$i][2] = Square::create($i, 2, new Pawn(Side::WHITE));
        }

        #black pieces
        $expectedSquares[1][BoardConfig::MAX_COORDINATE] = Square::create(
            1,
            BoardConfig::MAX_COORDINATE,
            new Rook(Side::BLACK)
        );
        $expectedSquares[2][BoardConfig::MAX_COORDINATE] = Square::create(
            2,
            BoardConfig::MAX_COORDINATE,
            new Knight(Side::BLACK)
        );
        $expectedSquares[3][BoardConfig::MAX_COORDINATE] = Square::create(
            3,
            BoardConfig::MAX_COORDINATE,
            new Bishop(Side::BLACK)
        );
        $expectedSquares[4][BoardConfig::MAX_COORDINATE] = Square::create(
            4,
            BoardConfig::MAX_COORDINATE,
            new Queen(Side::BLACK)
        );
        $expectedSquares[5][BoardConfig::MAX_COORDINATE] = Square::create(
            5,
            BoardConfig::MAX_COORDINATE,
            new King(Side::BLACK)
        );
        $expectedSquares[6][BoardConfig::MAX_COORDINATE] = Square::create(
            6,
            BoardConfig::MAX_COORDINATE,
            new Bishop(Side::BLACK)
        );
        $expectedSquares[7][BoardConfig::MAX_COORDINATE] = Square::create(
            7,
            BoardConfig::MAX_COORDINATE,
            new Knight(Side::BLACK)
        );
        $expectedSquares[8][BoardConfig::MAX_COORDINATE] = Square::create(
            8,
            BoardConfig::MAX_COORDINATE,
            new Rook(Side::BLACK)
        );
        #black pawns
        for ($i = 1; $i <= 8; $i++) {
            $expectedSquares[$i][7] = Square::create($i, 2, new Pawn(Side::BLACK));
        }

        $this->assertEquals($expectedSquares[BoardConfig::MIN_COORDINATE], $resetResult[BoardConfig::MIN_COORDINATE]);
        $this->assertEquals($expectedSquares[BoardConfig::MAX_COORDINATE], $resetResult[BoardConfig::MAX_COORDINATE]);
        $this->assertNull($resetResult[rand(3, 6)][rand(1, 8)]->getPiece());
    }

    public function testGetSquare()
    {
        $b = new Board();
        $b->reset();
        $expectedSquare = Square::create(1,1, new Rook(Side::WHITE));
        $result = $b->getSquare(1, 1);

        $this->assertEquals($expectedSquare, $result);
    }

    public function testGetSquaresWithoutResetWillBeEmpty()
    {
        $b = new Board();
        $this->assertEmpty($b->getSquares());
    }

    public function testGetSquareWithUnknownYCoordinate()
    {
        $this->expectException(UnknownYCoordinateException::class);

        $b = new Board();
        $b->reset();
        $b->getSquare(48, 2);
    }

    public function testGetSquareWithUnknownXCoordinate()
    {
        $this->expectException(UnknownXCoordinateException::class);

        $b = new Board();
        $b->reset();
        $b->getSquare(1, 25);
    }
}