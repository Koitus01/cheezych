<?php

namespace App\Tests\Unit;

use App\Domain\Board;
use App\Domain\Exceptions\UnknownXCoordinateException;
use App\Domain\Exceptions\UnknownYCoordinateException;
use App\Domain\Square;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    public function testResetBoard()
    {
        $b = new Board();
        $b->reset();

        $expectedSquares[1][1] = Square::create(1, 1);
        $expectedSquares[1][2] = Square::create(1, 2);
        $expectedSquares[1][3] = Square::create(1, 3);
        $expectedSquares[1][4] = Square::create(1, 4);
        $expectedSquares[1][5] = Square::create(1, 5);
        $expectedSquares[1][6] = Square::create(1, 6);
        $expectedSquares[1][7] = Square::create(1, 7);
        $expectedSquares[1][8] = new Square(1, 8);

        $expectedSquares[2][1] = new Square(2, 1);
        $expectedSquares[2][2] = new Square(2, 2);
        $expectedSquares[2][3] = new Square(2, 3);
        $expectedSquares[2][4] = new Square(2, 4);
        $expectedSquares[2][5] = new Square(2, 5);
        $expectedSquares[2][6] = new Square(2, 6);
        $expectedSquares[2][7] = new Square(2, 7);
        $expectedSquares[2][8] = new Square(2, 8);

        $this->assertEquals($expectedSquares, $b->getSquares());
    }

    public function testGetSquare()
    {
        $b = new Board();
        $b->reset();
        $b->getSquare(1, 2);
    }

    public function testGetSquareWithUnknownYCoordinate()
    {
        $this->expectException(UnknownYCoordinateException::class);

        $b = new Board();
        $b->getSquare(1, 2);
    }

    public function testGetSquareWithUnknownXCoordinate()
    {
        $this->expectException(UnknownXCoordinateException::class);

        $b = new Board();
        $b->getSquare(1, 2);
    }
}