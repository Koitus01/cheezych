<?php

namespace App\Tests\Unit\Domain\Entity\Pieces;

use App\Domain\DTO\MovementCoordinatesDTO;
use App\Domain\Entity\Pieces\Bishop;
use Generator;
use PHPUnit\Framework\TestCase;

class BishopTest extends TestCase
{
    public function testIsValidMovement()
    {
        $b = new Bishop();
        $coordinates = new MovementCoordinatesDTO(2, 1, 3, 2);
        $result = $b->isValidMovement($coordinates);
        $this->assertTrue($result);
    }

    public function testCannotMoveHorizontally()
    {
        $b = new Bishop();
        $coordinates = new MovementCoordinatesDTO(1, 1, 3, 1);
        $result = $b->isValidMovement($coordinates);
        $this->assertFalse($result);
    }

    public function testCannotMoveVertically()
    {
        $b = new Bishop();
        $coordinates = new MovementCoordinatesDTO(1, 1, 1, 3);
        $result = $b->isValidMovement($coordinates);
        $this->assertFalse($result);
    }

    /**
     * @dataProvider provideNotDiagonallyCoordinates
     */
    public function testCanOnlyMoveDiagonally($coordinates)
    {
        $b = new Bishop();
        $coordinates = new MovementCoordinatesDTO(
            $coordinates['xFrom'],
            $coordinates['yFrom'],
            $coordinates['xTo'],
            $coordinates['yTo']
        );
        $result = $b->isValidMovement($coordinates);
        $this->assertFalse($result);
    }

    public static function provideNotDiagonallyCoordinates(): Generator
    {
        yield 'coordinates: 2, 1, 25, 1' => [
            [
                'xFrom' => 2,
                'yFrom' => 1,
                'xTo' => 25,
                'yTo' => 1,

            ]
        ];

        yield 'coordinates: 1, 2, 1, 7' => [
            [
                'xFrom' => 1,
                'yFrom' => 2,
                'xTo' => 1,
                'yTo' => 7,
            ]
        ];

        yield 'coordinates: 2, 1, 5, 7' => [
            [
                'xFrom' => 2,
                'yFrom' => 1,
                'xTo' => 5,
                'yTo' => 7,
            ]
        ];

        yield 'coordinates: 2, 1, 3, 4' => [
            [
                'xFrom' => 2,
                'yFrom' => 1,
                'xTo' => 3,
                'yTo' => 4,
            ]
        ];

        yield 'coordinates: 5, 5, 2, 3' => [
            [
                'xFrom' => 5,
                'yFrom' => 5,
                'xTo' => 2,
                'yTo' => 3,
            ]
        ];

        yield 'coordinates: 8, 8, 1, 8' => [
            [
                'xFrom' => 8,
                'yFrom' => 8,
                'xTo' => 1,
                'yTo' => 8,
            ]
        ];
    }


}