<?php

namespace App\Tests\Unit\Pieces;

use App\Domain\Color;
use App\Domain\Pieces\Pawn;
use PHPUnit\Framework\TestCase;

class PawnTest extends TestCase
{
    public function testGetColor()
    {
        $p = new Pawn(Color::WHITE);
        $this->assertEquals(Color::WHITE, $p->color);
    }

    public function testMovementPattern(): void
    {
        $pawn = new Pawn(Color::WHITE);
        $movementPattern = $pawn->getMovementPattern();


    }
}