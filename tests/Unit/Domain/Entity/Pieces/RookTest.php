<?php

namespace App\Tests\Unit\Domain\Entity\Pieces;

use App\Domain\Entity\Pieces\Rook;
use App\Domain\Enums\Side;
use PHPUnit\Framework\TestCase;

class RookTest extends TestCase
{
    public function testIsValidMovement()
    {
        $r = new Rook(Side::WHITE);
        $result = $r->isValidMovement(1, 2, 1, 2);
        $this->assertTrue($result);
    }

    public function testDiagonalMovementIsNotValid()
    {
        $r = new Rook(Side::WHITE);
        $result = $r->isValidMovement(1, 2, 2, 3);
        $this->assertFalse($result);
    }
}