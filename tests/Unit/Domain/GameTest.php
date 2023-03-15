<?php

namespace App\Tests\Unit\Domain;

use App\Domain\Board;
use App\Domain\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testGetBoard()
    {
        $g = new Game();
        $g->setBoard(new Board());
        $this->assertNotEmpty($g->getBoard());
    }

    public function testGetPlayers()
    {

    }

    public function testGetWhitePlayer()
    {

    }

    public function testGetBlackPlayer()
    {

    }

    public function testGetStatus()
    {

    }

    public function testGetWinner()
    {

    }

    public function testGetLoser()
    {

    }

    public function testGetCurrentTurn()
    {

    }
}