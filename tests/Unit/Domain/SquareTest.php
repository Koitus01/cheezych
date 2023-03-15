<?php

namespace App\Tests\Unit\Domain;

use App\Domain\Enums\Color;
use App\Domain\Pieces\Pawn;
use App\Domain\Square;
use PHPUnit\Framework\TestCase;

class SquareTest extends TestCase
{
    public function testSetPiece()
    {
        $spot = new Square(1, 2);
        $pawn = new Pawn(Color::BLACK);
        $spot->setPiece($pawn);

        $this->assertEquals($pawn, $spot->getPiece());
    }

    public function testGetNullPiece()
    {
        $spot = new Square(1, 2);
        $this->assertEquals(null, $spot->getPiece());
    }
}