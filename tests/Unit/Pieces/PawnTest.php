<?php

namespace App\Tests\Unit\Pieces;

use App\Domain\Pieces\Pawn;
use PHPUnit\Framework\TestCase;

class PawnTest extends TestCase
{
    public function testMovementPattern(): void
    {
        $pawn = new Pawn();
        $movementPattern = $pawn->getMovementPattern();


    }
}