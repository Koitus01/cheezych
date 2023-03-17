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

        $expectedSquares[BoardConfig::MIN_COORDINATE][1] = Square::create(
            BoardConfig::MIN_COORDINATE,
            1,
            new Rook(Side::WHITE)
        );
        $expectedSquares[BoardConfig::MIN_COORDINATE][2] = Square::create(
            BoardConfig::MIN_COORDINATE,
            2,
            new Knight(Side::WHITE)
        );
        $expectedSquares[BoardConfig::MIN_COORDINATE][3] = Square::create(
            BoardConfig::MIN_COORDINATE,
            3,
            new Bishop(Side::WHITE)
        );
        $expectedSquares[BoardConfig::MIN_COORDINATE][4] = Square::create(
            BoardConfig::MIN_COORDINATE,
            4,
            new Queen(Side::WHITE)
        );
        $expectedSquares[BoardConfig::MIN_COORDINATE][5] = Square::create(
            BoardConfig::MIN_COORDINATE,
            5,
            new King(Side::WHITE)
        );
        $expectedSquares[BoardConfig::MIN_COORDINATE][6] = Square::create(
            BoardConfig::MIN_COORDINATE,
            6,
            new Bishop(Side::WHITE)
        );
        $expectedSquares[BoardConfig::MIN_COORDINATE][7] = Square::create(
            BoardConfig::MIN_COORDINATE,
            7,
            new Knight(Side::WHITE)
        );
        $expectedSquares[BoardConfig::MIN_COORDINATE][8] = Square::create(
            BoardConfig::MIN_COORDINATE,
            8,
            new Rook(Side::WHITE)
        );
        for ($i = 1; $i <= 8; $i++) {
            $expectedSquares[2][$i] = Square::create(2, $i, new Pawn(Side::WHITE));
        }

        #создаем поля с черными
        $expectedSquares[BoardConfig::MAX_COORDINATE][1] = Square::create(
            BoardConfig::MAX_COORDINATE,
            1,
            new Rook(Side::BLACK)
        );
        $expectedSquares[BoardConfig::MAX_COORDINATE][2] = Square::create(
            BoardConfig::MAX_COORDINATE,
            2,
            new Knight(Side::BLACK)
        );
        $expectedSquares[BoardConfig::MAX_COORDINATE][3] = Square::create(
            BoardConfig::MAX_COORDINATE,
            3,
            new Bishop(Side::BLACK)
        );
        $expectedSquares[BoardConfig::MAX_COORDINATE][4] = Square::create(
            BoardConfig::MAX_COORDINATE,
            4,
            new Queen(Side::BLACK)
        );
        $expectedSquares[BoardConfig::MAX_COORDINATE][5] = Square::create(
            BoardConfig::MAX_COORDINATE,
            5,
            new King(Side::BLACK)
        );
        $expectedSquares[BoardConfig::MAX_COORDINATE][6] = Square::create(
            BoardConfig::MAX_COORDINATE,
            6,
            new Bishop(Side::BLACK)
        );
        $expectedSquares[BoardConfig::MAX_COORDINATE][7] = Square::create(
            BoardConfig::MAX_COORDINATE,
            7,
            new Knight(Side::BLACK)
        );
        $expectedSquares[BoardConfig::MAX_COORDINATE][8] = Square::create(
            BoardConfig::MAX_COORDINATE,
            8,
            new Rook(Side::BLACK)
        );

        $this->assertEquals($expectedSquares[BoardConfig::MIN_COORDINATE], $resetResult[BoardConfig::MIN_COORDINATE]);
        $this->assertEquals($expectedSquares[BoardConfig::MAX_COORDINATE], $resetResult[BoardConfig::MAX_COORDINATE]);
        $this->assertNull($resetResult[rand(3, 6)][rand(1, 8)]->getPiece());
    }

    public function testGetSquare()
    {
        $b = new Board();
        $b->reset();
        $expectedSquare = Square::create(1,2, new Knight(Side::WHITE));
        $result = $b->getSquare(1, 2);

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