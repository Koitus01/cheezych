<?php

namespace App\Tests\Unit\Domain\Entity\Pieces;

use App\Domain\Entity\Pieces\Queen;
use PHPUnit\Framework\TestCase;

class QueenTest extends TestCase
{
    /**
     * @dataProvider provideValidMovements
     */
    public function testValidMovements()
    {
        $q = new Queen();
        $result = $q->isValidMovement(1, 5, 5, 5);
        $this->assertTrue($result);
    }

    public function testKnightMovementIsInvalid()
    {
        $q = new Queen();
        $result = $q->isValidMovement(1, 5, 3, 6);
        $this->assertFalse($result);
    }

    public function provideValidMovements()
    {
        yield 'coordinates: 1, 5, 1, 8' => [
            [
                'yFrom' => 1,
                'xFrom' => 5,
                'yTo' => 1,
                'xTo' => 8
            ]
        ];

        yield 'coordinates: 1, 8, 4, 6' => [
            [
                'yFrom' => 1,
                'xFrom' => 8,
                'yTo' => 4,
                'xTo' => 6
            ]
        ];

        yield 'coordinates: 4, 6, 8, 6' => [
            [
                'yFrom' => 4,
                'xFrom' => 6,
                'yTo' => 8,
                'xTo' => 6
            ]
        ];

        yield 'coordinates: 8, 6, 4, 2' => [
            [
                'yFrom' => 8,
                'xFrom' => 6,
                'yTo' => 4,
                'xTo' => 2
            ]
        ];
    }
}