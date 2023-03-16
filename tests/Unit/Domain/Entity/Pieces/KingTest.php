<?php

namespace App\Tests\Unit\Domain\Entity\Pieces;

use App\Domain\Entity\Pieces\King;
use PHPUnit\Framework\TestCase;

class KingTest extends TestCase
{
    public function testIsValidMovement()
    {
        $k = new King();
        $result = $k->isValidMovement(1, 1, 2, 2);
        $this->assertTrue($result);
    }

    public function testCannotCrossTwoYSquaresAlongYAxis()
    {
        $k = new King();
        $result = $k->isValidMovement(1, 1, 3, 1);
        $this->assertFalse($result);
    }

    public function testCannotCrossTwoYSquaresAlongXAxis()
    {
        $k = new King();
        $result = $k->isValidMovement(1, 1, 1, 3);
        $this->assertFalse($result);
    }

    public function testCannotCrossTwoYSquaresAlongYAxisAndXAxis()
    {
        $k = new King();
        $result = $k->isValidMovement(1, 1, 3, 3);
        $this->assertFalse($result);
    }
}