<?php

namespace App\Tests\Unit\Domain\Entity\Pieces;

use App\Domain\Entity\Pieces\Pawn;
use Generator;
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

    public function testIsValidCapture()
    {
        $p = new Pawn();
        $result = $p->isValidCapture(4, 2, 5, 3);
        $this->assertTrue($result);
    }

    /**
     * @dataProvider provideIncorrectCaptureCoordinates
     */
    public function testCanOnlyCaptureDiagonallyAcrossOneSquare($coordinates)
    {
        $p = new Pawn();
        $result = $p->isValidCapture(
            $coordinates['yFrom'],
            $coordinates['xFrom'],
            $coordinates['yTo'],
            $coordinates['xTo']
        );
        $this->assertFalse($result);
    }

    public function provideIncorrectCaptureCoordinates(): Generator
    {
        yield 'coordinates: 4, 2, 5, 2' => [
            [
                'yFrom' => 4,
                'xFrom' => 2,
                'yTo' => 5,
                'xTo' => 2
            ]
        ];

        yield 'coordinates: 4, 2, 8, 2' => [
            [
                'yFrom' => 4,
                'xFrom' => 2,
                'yTo' => 8,
                'xTo' => 2
            ]
        ];

        yield 'coordinates: 4, 2, 8, 8' => [
            [
                'yFrom' => 4,
                'xFrom' => 2,
                'yTo' => 8,
                'xTo' => 8
            ]
        ];

        yield 'coordinates: 4, 2, 8, 1' => [
            [
                'yFrom' => 4,
                'xFrom' => 2,
                'yTo' => 8,
                'xTo' => 1
            ]
        ];

        yield 'coordinates: 4, 2, 3, 3' => [
            [
                'yFrom' => 4,
                'xFrom' => 2,
                'yTo' => 3,
                'xTo' => 3
            ]
        ];
    }
}