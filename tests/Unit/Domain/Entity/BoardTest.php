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

        for ($x = 1 ; $x <= 8; $x++) {
            $this->assertEquals(new Pawn(Side::WHITE), $b->getSquare($x, 2)->getPiece());
        }
        $this->assertEquals(new King(Side::WHITE), $b->getSquare(5, 1)->getPiece());
        $this->assertEquals(new King(Side::BLACK), $b->getSquare(5, 8)->getPiece());
        $this->assertEquals(new Queen(Side::WHITE), $b->getSquare(4, 1)->getPiece());
        $this->assertEquals(new Queen(Side::BLACK), $b->getSquare(4, 8)->getPiece());
        $this->assertEquals(new Rook(Side::WHITE), $b->getSquare(1, 1)->getPiece());
        $this->assertEquals(new Rook(Side::WHITE), $b->getSquare(8, 1)->getPiece());
        $this->assertEquals(new Rook(Side::BLACK), $b->getSquare(1, 8)->getPiece());
        $this->assertEquals(new Rook(Side::BLACK), $b->getSquare(8, 8)->getPiece());
        $this->assertEquals(new Bishop(Side::WHITE), $b->getSquare(3, 1)->getPiece());
        $this->assertEquals(new Bishop(Side::WHITE), $b->getSquare(6, 1)->getPiece());
        $this->assertEquals(new Bishop(Side::BLACK), $b->getSquare(3, 8)->getPiece());
        $this->assertEquals(new Bishop(Side::BLACK), $b->getSquare(6, 8)->getPiece());
        $this->assertEquals(new Knight(Side::WHITE), $b->getSquare(2, 1)->getPiece());
        $this->assertEquals(new Knight(Side::WHITE), $b->getSquare(7, 1)->getPiece());
        $this->assertEquals(new Knight(Side::BLACK), $b->getSquare(2, 8)->getPiece());
        $this->assertEquals(new Knight(Side::BLACK), $b->getSquare(7, 8)->getPiece());
        $this->assertNull($resetResult[rand(1, 8)][rand(3, 6)]->getPiece());
    }

    public function testEmptySquaresAfterReset()
    {
        $b = new Board();
        $b->reset();

        for ($x = BoardConfig::MIN_COORDINATE; $x <= BoardConfig::MAX_COORDINATE; $x++) {
            for ($y = 3; $y <= 6; $y++) {
                $this->assertNull($b->getSquare($x, $y)->getPiece());
            }
        }
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
        $b->getSquare(2, 48);
    }

    public function testGetSquareWithUnknownXCoordinate()
    {
        $this->expectException(UnknownXCoordinateException::class);

        $b = new Board();
        $b->reset();
        $b->getSquare(25, 1);
    }
}