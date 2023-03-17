<?php

namespace App\Tests\Unit\Domain\Entity\Pieces;

use App\Domain\DTO\MovementCoordinatesDTO;
use App\Domain\Entity\Pieces\Rook;
use App\Domain\Enums\PieceName;
use PHPUnit\Framework\TestCase;

class RookTest extends TestCase
{
    /**
     * @dataProvider provideValidMovements
     */
    public function testIsValidMovement($coordinates)
    {
        $r = new Rook();
        $coordinates = new MovementCoordinatesDTO(
            $coordinates['xFrom'],
            $coordinates['yFrom'],
            $coordinates['xTo'],
            $coordinates['yTo']
        );
        $result = $r->isValidMovement($coordinates);
        $this->assertTrue($result);
    }

    public function testDiagonalMovementIsNotValid()
    {
        $r = new Rook();
        $coordinates = new MovementCoordinatesDTO(1, 1, 3, 3);
        $result = $r->isValidMovement($coordinates);
        $this->assertFalse($result);
    }

    public function testKnightMovementIsInvalid()
    {
        $r = new Rook();
        $coordinates = new MovementCoordinatesDTO(2, 1, 3, 3);
        $result = $r->isValidMovement($coordinates);
        $this->assertFalse($result);
    }

    public function testGetName()
    {
        $r = new Rook();
        $this->assertEquals(PieceName::ROOK, $r->getName());
    }

    public function provideValidMovements()
    {
        yield 'coordinates: 1, 1, 8, 1' => [
            [
                'xFrom' => 1,
                'yFrom' => 1,
                'xTo' => 8,
                'yTo' => 1,
            ]
        ];

        yield 'coordinates: 1, 8, 1, 1' => [
            [
                'xFrom' => 1,
                'yFrom' => 8,
                'xTo' => 1,
                'yTo' => 1,
            ]
        ];

        yield 'coordinates: 5, 4, 5, 1' => [
            [
                'xFrom' => 5,
                'yFrom' => 4,
                'xTo' => 5,
                'yTo' => 1,
            ]
        ];
    }
}