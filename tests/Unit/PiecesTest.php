<?php

namespace App\Tests\Unit;

use App\Domain\Enums\Color;
use App\Domain\Pieces\Pawn;
use PHPUnit\Framework\TestCase;

class PiecesTest extends TestCase
{
    public function testGetColor()
    {
        $p = new Pawn(Color::WHITE);
        $this->assertEquals(Color::WHITE, $p->color);
    }

    public function testIsWhite()
    {
        $p = new Pawn(Color::WHITE);
        $this->assertTrue($p->isWhite());
    }

    public function testIsBlack()
    {
        $p = new Pawn(Color::BLACK);
        $this->assertTrue($p->isBlack());
    }

    public function testMovementPattern(): void
    {
        $pawn = new Pawn(Color::WHITE);
        $movementPattern = $pawn->getMovementPattern();


    }
}