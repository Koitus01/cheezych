<?php

namespace App\Tests\Unit\Domain\Entity;

use App\Domain\Entity\Pieces\Pawn;
use App\Domain\Entity\Square;
use App\Domain\Enums\Side;
use PHPUnit\Framework\TestCase;

class SquareTest extends TestCase
{
    public function testSetPiece()
    {
        $spot = new Square(1, 2);
        $pawn = new Pawn(Side::BLACK);
        $spot->setPiece($pawn);

        $this->assertEquals($pawn, $spot->getPiece());
    }

    public function testGetNullPiece()
    {
        $spot = new Square(1, 2);
        $this->assertEquals(null, $spot->getPiece());
    }
}