<?php

namespace App\Tests\Unit\Domain\Entity\Pieces;

use App\Domain\Entity\Pieces\Knight;
use App\Domain\Enums\PieceName;
use PHPUnit\Framework\TestCase;

class KnightTest extends TestCase
{
    /**
     * @dataProvider provideValidCoordinates
     */
    public function testValidMovements($coordinates)
    {
        $k = new Knight();
        $result = $k->isValidMovement(
            $coordinates['yFrom'],
            $coordinates['xFrom'],
            $coordinates['yTo'],
            $coordinates['xTo']
        );
        $this->assertTrue($result);
    }

    public function testMoveVerticallyIsInvalid()
    {
        $k = new Knight();
        $result = $k->isValidMovement(1, 2, 2, 2);
        $this->assertFalse($result);
    }

    public function testMoveHorizontallyIsInvalid()
    {
        $k = new Knight();
        $result = $k->isValidMovement(1, 2, 1, 3);
        $this->assertFalse($result);
    }

    public function testMoveDiagonallyIsInvalid()
    {
        $k = new Knight();
        $result = $k->isValidMovement(1, 2, 2, 3);
        $this->assertFalse($result);
    }

    public function testMoveDiagonallyAcrossTwoSquaresIsInvalid()
    {
        $k = new Knight();
        $result = $k->isValidMovement(1, 2, 3, 4);
        $this->assertFalse($result);
    }

    public function testGetName()
    {
        $k = new Knight();
        $this->assertEquals(PieceName::KNIGHT, $k->getName());
    }

    public static function provideValidCoordinates()
    {
        yield 'coordinates: 4, 5, 3, 3' => [
            [
                'yFrom' => 4,
                'xFrom' => 5,
                'yTo' => 3,
                'xTo' => 3
            ]
        ];

        yield 'coordinates: 3, 3, 1, 2' => [
            [
                'yFrom' => 3,
                'xFrom' => 3,
                'yTo' => 1,
                'xTo' => 2
            ]
        ];

        yield 'coordinates: 4, 5, 6, 6' => [
            [
                'yFrom' => 4,
                'xFrom' => 5,
                'yTo' => 6,
                'xTo' => 6
            ]
        ];

        yield 'coordinates: 6, 6, 5, 8' => [
            [
                'yFrom' => 6,
                'xFrom' => 6,
                'yTo' => 5,
                'xTo' => 8
            ]
        ];
    }
}