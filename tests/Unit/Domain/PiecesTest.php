<?php

namespace App\Tests\Unit\Domain;

use App\Domain\Enums\Side;
use App\Domain\Enums\PieceName;
use App\Domain\Pieces\Pawn;
use PHPUnit\Framework\TestCase;

class PiecesTest extends TestCase
{
    public function testGetSide()
    {
        $p = new Pawn(Side::WHITE);
        $this->assertEquals(Side::WHITE, $p->side);
    }

    public function testIsWhite()
    {
        $p = new Pawn(Side::WHITE);
        $this->assertTrue($p->isWhite());
    }

    public function testIsBlack()
    {
        $p = new Pawn(Side::BLACK);
        $this->assertTrue($p->isBlack());
    }

    public function testGetPawnName()
    {
        $p = new Pawn(Side::WHITE);
        $this->assertEquals(PieceName::PAWN, $p->getName());
    }

/*    public function testMovementPattern(): void
    {
        $pawn = new Pawn(Side::WHITE);
        $movementPattern = $pawn->getMovementPattern();


    }*/
}