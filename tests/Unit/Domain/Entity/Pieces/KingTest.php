<?php

namespace App\Tests\Unit\Domain\Entity\Pieces;

use App\Domain\DTO\MovementCoordinatesDTO;
use App\Domain\Entity\Pieces\King;
use PHPUnit\Framework\TestCase;

class KingTest extends TestCase
{
    public function testIsValidMovement()
    {
        $k = new King();
        $coordinates = new MovementCoordinatesDTO(1, 1, 2, 2);
        $result = $k->isValidMovement($coordinates);
        $this->assertTrue($result);
    }

    public function testCannotCrossTwoYSquaresAlongYAxis()
    {
        $k = new King();
        $coordinates = new MovementCoordinatesDTO(1, 1, 1, 3);
        $result = $k->isValidMovement($coordinates);
        $this->assertFalse($result);
    }

    public function testCannotCrossTwoYSquaresAlongXAxis()
    {
        $k = new King();
        $coordinates = new MovementCoordinatesDTO(1, 1, 3, 1);
        $result = $k->isValidMovement($coordinates);
        $this->assertFalse($result);
    }

    public function testCannotMoveDiagonallyAcrossMoreThanTwoSquares()
    {
        $k = new King();
        $coordinates = new MovementCoordinatesDTO(1, 1, 3, 3);
        $result = $k->isValidMovement($coordinates);
        $this->assertFalse($result);
    }
}