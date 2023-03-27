<?php

namespace App\Tests\Unit\Domain\Entity\Pieces;

use App\Domain\DTO\MovementCoordinatesDTO;
use App\Domain\Entity\Pieces\Pawn;
use App\Domain\Enums\Side;
use Generator;
use PHPUnit\Framework\TestCase;

class PawnTest extends TestCase
{
    public function testIsValidMovement()
    {
        $p = new Pawn();
        $coordinates = new MovementCoordinatesDTO(2, 2, 2, 3);
        $result = $p->isValidMovement($coordinates);
        $this->assertTrue($result);
    }

    public function testHorizontallyMovementIsInvalid()
    {
        $p = new Pawn();
        $coordinates = new MovementCoordinatesDTO(2, 2, 3, 2);
        $result = $p->isValidMovement($coordinates);
        $this->assertFalse($result);
    }

    public function testWhiteCanCrossTwoSquaresFromOriginalPosition()
    {
        $p = new Pawn();
        $coordinates = new MovementCoordinatesDTO(2, 2, 2, 4);
        $result = $p->isValidMovement($coordinates);
        $this->assertTrue($result);
    }

    public function testBlackCannotMoveAcrossTwoSquaresLikeWhite()
    {
        $p = new Pawn(Side::BLACK);
        $coordinates = new MovementCoordinatesDTO(2, 2, 2, 4);
        $result = $p->isValidMovement($coordinates);
        $this->assertFalse($result);
    }

    public function testBlackCanMoveAcrossTwoSquares()
    {
        $p = new Pawn(Side::BLACK);
        $coordinates = new MovementCoordinatesDTO(1, 7, 1, 5);
        $result = $p->isValidMovement($coordinates);
        $this->assertTrue($result);
    }

    public function testCannotCrossMoreThanTwoSquares()
    {
        $p = new Pawn();
        $coordinates = new MovementCoordinatesDTO(1, 3, 1, 5);
        $result = $p->isValidMovement($coordinates);
        $this->assertFalse($result);
    }

    public function testWhiteCannotMoveBackward()
    {
        $p = new Pawn();
        $coordinates = new MovementCoordinatesDTO(1, 3, 1, 5);
        $result = $p->isValidMovement($coordinates);
        $this->assertFalse($result);
    }

    public function testBlackCannotMoveBackward()
    {
        $p = new Pawn(Side::BLACK);
        $coordinates = new MovementCoordinatesDTO(1, 6, 1, 7);
        $result = $p->isValidMovement($coordinates);
        $this->assertFalse($result);
    }

    public function testIsValidCapture()
    {
        $p = new Pawn();
        $coordinates = new MovementCoordinatesDTO(1, 2, 2, 3);
        $result = $p->isValidCapture($coordinates);
        $this->assertTrue($result);
    }

    public function testBlackCannotCaptureLikeWhite()
    {
        $p = new Pawn(Side::BLACK);
        $coordinates = new MovementCoordinatesDTO(1, 2, 2, 3);
        $result = $p->isValidCapture($coordinates);
        $this->assertFalse($result);
    }

    /**
     * @dataProvider provideIncorrectCaptureCoordinates
     */
    public function testCanOnlyCaptureDiagonallyAcrossOneSquare($coordinates)
    {
        $p = new Pawn();
        $coordinates = new MovementCoordinatesDTO(
            $coordinates['xFrom'],
            $coordinates['yFrom'],
            $coordinates['xTo'],
            $coordinates['yTo']
        );
        $result = $p->isValidCapture($coordinates);
        $this->assertFalse($result);
    }

    public function provideIncorrectCaptureCoordinates(): Generator
    {
        yield 'coordinates: 2, 4, 2, 5' => [
            [
                'xFrom' => 2,
                'yFrom' => 4,
                'xTo' => 2,
                'yTo' => 5,
            ]
        ];

        yield 'coordinates: 2, 4, 2, 8' => [
            [
                'xFrom' => 2,
                'yFrom' => 4,
                'xTo' => 2,
                'yTo' => 8,

            ]
        ];

        yield 'coordinates: 2, 4, 8, 8' => [
            [
                'xFrom' => 2,
                'yFrom' => 4,
                'xTo' => 8,
                'yTo' => 8,
            ]
        ];

        yield 'coordinates: 2, 4, 1, 8' => [
            [
                'xFrom' => 2,
                'yFrom' => 4,
                'xTo' => 1,
                'yTo' => 8,

            ]
        ];
    }
}