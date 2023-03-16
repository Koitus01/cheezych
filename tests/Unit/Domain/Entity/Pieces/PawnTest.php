<?php

namespace App\Tests\Unit\Domain\Entity\Pieces;

use App\Domain\Entity\Pieces\Pawn;
use PHPUnit\Framework\TestCase;

class PawnTest extends TestCase
{
    public function testIsValidMovement()
    {
        $p = new Pawn();
        $result = $p->isValidMovement(2, 2, 3, 2);
        $this->assertTrue($result);
    }

    public function testXAxisMovementIsInvalid()
    {
        $p = new Pawn();
        $result = $p->isValidMovement(1, 2, 1, 3);
        $this->assertFalse($result);
    }

    public function testCanCrossTwoSquaresFromOriginalPosition()
    {
        $p = new Pawn();
        $result = $p->isValidMovement(2, 2, 4, 2);
        $this->assertTrue($result);
    }

    public function testCannotCrossMoreThanTwoSquares()
    {
        $p = new Pawn();
        $result = $p->isValidMovement(2, 2, 6, 2);
        $this->assertTrue($result);
    }

    public function testCannotMoveBackward()
    {
        $p = new Pawn();
        $result = $p->isValidMovement(2, 2, 1, 2);
        $this->assertFalse($result);
    }

}