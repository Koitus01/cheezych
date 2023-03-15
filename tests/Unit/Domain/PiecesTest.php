<?php

namespace App\Tests\Unit\Domain;

use App\Domain\Enums\Color;
use App\Domain\Enums\PieceName;
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

    public function testGetPawnName()
    {
        $p = new Pawn(Color::WHITE);
        $this->assertEquals(PieceName::PAWN, $p->getName());
    }

    public function testMovementPattern(): void
    {
        $pawn = new Pawn(Color::WHITE);
        $movementPattern = $pawn->getMovementPattern();


    }
}