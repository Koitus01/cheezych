<?php

namespace App\Tests\Unit;

use App\Domain\Pieces\Pawn;
use App\Domain\Spot;
use PHPUnit\Framework\TestCase;

class SpotTest extends TestCase
{
    public function testSetPiece()
    {
        $spot = new Spot(1, 2);
        $pawn = new Pawn();
        $spot->setPiece($pawn);

        $this->assertEquals($pawn, $spot->getPiece());
    }

    public function testGetNullPiece()
    {
        $spot = new Spot(1, 2);
        $this->assertEquals(null, $spot->getPiece());
    }
}