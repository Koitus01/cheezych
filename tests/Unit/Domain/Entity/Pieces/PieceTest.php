<?php

namespace App\Tests\Unit\Domain\Entity\Pieces;

use App\Domain\Entity\Pieces\Pawn;
use App\Domain\Enums\PieceName;
use App\Domain\Enums\Side;
use PHPUnit\Framework\TestCase;

class PieceTest extends TestCase
{
    public function testGetSide()
    {
        $p = new Pawn(Side::WHITE);
        $this->assertEquals(Side::WHITE, $p->getSide());
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
}