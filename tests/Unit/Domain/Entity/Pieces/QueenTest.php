<?php

namespace App\Tests\Unit\Domain\Entity\Pieces;

use App\Domain\DTO\MovementCoordinatesDTO;
use App\Domain\Entity\Pieces\Queen;
use PHPUnit\Framework\TestCase;

class QueenTest extends TestCase
{
    /**
     * @dataProvider provideValidMovements
     */
    public function testValidMovements($coordinates)
    {
        $q = new Queen();
        $coordinates = new MovementCoordinatesDTO(
            $coordinates['xFrom'],
            $coordinates['yFrom'],
            $coordinates['xTo'],
            $coordinates['yTo']
        );
        $result = $q->isValidMovement($coordinates);
        $this->assertTrue($result);
    }

    public function testKnightMovementIsInvalid()
    {
        $q = new Queen();
        $coordinates = new MovementCoordinatesDTO(2, 1, 3, 3);
        $result = $q->isValidMovement($coordinates);
        $this->assertFalse($result);
    }

    public static function provideValidMovements()
    {
        yield 'coordinates: 5, 1, 8, 1' => [
            [
                'xFrom' => 5,
                'yFrom' => 1,
                'xTo' => 8,
                'yTo' => 1,
            ]
        ];

        yield 'coordinates: 6, 4, 6, 8' => [
            [
                'xFrom' => 6,
                'yFrom' => 4,
                'xTo' => 6,
                'yTo' => 8,
            ]
        ];

        yield 'coordinates: 6, 8, 2, 4' => [
            [
                'xFrom' => 6,
                'yFrom' => 8,
                'xTo' => 2,
                'yTo' => 4,
            ]
        ];

        yield 'coordinates: 2, 4, 3, 3' => [
            [
                'xFrom' => 2,
                'yFrom' => 4,
                'xTo' => 3,
                'yTo' => 3,
            ]
        ];
    }
}