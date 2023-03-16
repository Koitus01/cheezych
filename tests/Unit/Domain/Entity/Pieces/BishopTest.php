<?php

namespace App\Tests\Unit\Domain\Entity\Pieces;

use App\Domain\Entity\Pieces\Bishop;
use Generator;
use PHPUnit\Framework\TestCase;

class BishopTest extends TestCase
{
    public function testIsValidMovement()
    {
        $b = new Bishop();
        $result = $b->isValidMovement(1, 2, 2, 3);
        $this->assertTrue($result);
    }

    public function testCannotMoveHorizontally()
    {
        $b = new Bishop();
        $result = $b->isValidMovement(1, 1, 1, 3);
        $this->assertFalse($result);
    }

    public function testCannotMoveVertically()
    {
        $b = new Bishop();
        $result = $b->isValidMovement(1, 1, 3, 1);
        $this->assertFalse($result);
    }

    /**
     * @dataProvider provideNotDiagonallyCoordinates
     */
    public function testCanOnlyMoveDiagonally($coordinates)
    {
        $b = new Bishop();
        $result = $b->isValidMovement(
            $coordinates['yFrom'],
            $coordinates['xFrom'],
            $coordinates['yTo'],
            $coordinates['xTo']
        );
        $this->assertFalse($result);
    }

    public function provideNotDiagonallyCoordinates(): Generator
    {
        yield 'coordinates: 1, 2, 1, 25' => [
             [
                'yFrom' => 1,
                'xFrom' => 2,
                'yTo' => 1,
                'xTo' => 25
            ]
        ];

        yield 'coordinates: 1, 2, 1, 7' => [
            [
                'yFrom' => 1,
                'xFrom' => 2,
                'yTo' => 1,
                'xTo' => 7
            ]
        ];

        yield 'coordinates: 1, 2, 7, 5' => [
            [
                'yFrom' => 1,
                'xFrom' => 2,
                'yTo' => 7,
                'xTo' => 5
            ]
        ];

        yield 'coordinates: 1, 2, 4, 3' => [
            [
                'yFrom' => 1,
                'xFrom' => 2,
                'yTo' => 4,
                'xTo' => 3
            ]
        ];

        yield 'coordinates: 5, 5, 3, 2' => [
            [
                'yFrom' => 5,
                'xFrom' => 5,
                'yTo' => 3,
                'xTo' => 2
            ]
        ];

        yield 'coordinates: 8, 8, 8, 1' => [
            [
                'yFrom' => 8,
                'xFrom' => 8,
                'yTo' => 8,
                'xTo' => 1
            ]
        ];
    }


}