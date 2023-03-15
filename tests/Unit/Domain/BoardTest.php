<?php

namespace App\Tests\Unit\Domain;

use App\Domain\Board;
use App\Domain\Config\BoardConfig;
use App\Domain\Enums\Color;
use App\Domain\Exceptions\UnknownXCoordinateException;
use App\Domain\Exceptions\UnknownYCoordinateException;
use App\Domain\Pieces\Bishop;
use App\Domain\Pieces\King;
use App\Domain\Pieces\Knight;
use App\Domain\Pieces\Queen;
use App\Domain\Pieces\Rook;
use App\Domain\Square;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    public function testResetBoard()
    {
        $b = new Board();
        $resetResult = $b->reset();

        $expectedSquares[BoardConfig::MIN_COORDINATE][1] = Square::create(1, 1, new Rook(Color::WHITE));
        $expectedSquares[BoardConfig::MIN_COORDINATE][2] = Square::create(1, 2, new Knight(Color::WHITE));
        $expectedSquares[BoardConfig::MIN_COORDINATE][3] = Square::create(1, 3, new Bishop(Color::WHITE));
        $expectedSquares[BoardConfig::MIN_COORDINATE][4] = Square::create(1, 4, new Queen(Color::WHITE));
        $expectedSquares[BoardConfig::MIN_COORDINATE][5] = Square::create(1, 5, new King(Color::WHITE));
        $expectedSquares[BoardConfig::MIN_COORDINATE][6] = Square::create(1, 6, new Bishop(Color::WHITE));
        $expectedSquares[BoardConfig::MIN_COORDINATE][7] = Square::create(1, 7, new Knight(Color::WHITE));
        $expectedSquares[BoardConfig::MIN_COORDINATE][8] = Square::create(1, 8, new Rook(Color::WHITE));

        $expectedSquares[BoardConfig::MAX_COORDINATE][1] = Square::create(1, 1, new Rook(Color::BLACK));
        $expectedSquares[BoardConfig::MAX_COORDINATE][2] = Square::create(1, 2, new Knight(Color::BLACK));
        $expectedSquares[BoardConfig::MAX_COORDINATE][3] = Square::create(1, 3, new Bishop(Color::BLACK));
        $expectedSquares[BoardConfig::MAX_COORDINATE][4] = Square::create(1, 4, new Queen(Color::BLACK));
        $expectedSquares[BoardConfig::MAX_COORDINATE][5] = Square::create(1, 5, new King(Color::BLACK));
        $expectedSquares[BoardConfig::MAX_COORDINATE][6] = Square::create(1, 6, new Bishop(Color::BLACK));
        $expectedSquares[BoardConfig::MAX_COORDINATE][7] = Square::create(1, 7, new Knight(Color::BLACK));
        $expectedSquares[BoardConfig::MAX_COORDINATE][8] = Square::create(1, 8, new Rook(Color::BLACK));

        $this->assertEquals($expectedSquares[BoardConfig::MIN_COORDINATE], $resetResult[BoardConfig::MIN_COORDINATE]);
        $this->assertEquals($expectedSquares[BoardConfig::MAX_COORDINATE], $resetResult[BoardConfig::MAX_COORDINATE]);
        $this->assertNull($resetResult[rand(3, 6)][rand(1, 8)]->getPiece());
    }

    public function testGetSquare()
    {
        $b = new Board();
        $b->reset();
        $expectedSquare = Square::create(1,2, new Knight(Color::WHITE));
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