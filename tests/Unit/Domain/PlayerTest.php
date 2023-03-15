<?php

namespace App\Tests\Unit\Domain;

use App\Domain\Enums\Side;
use App\Domain\Player;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testGetName()
    {
        $p = new Player($this->playerName(), Side::WHITE, $this->gameId());
        $this->assertEquals($this->playerName(), $p->getName());

    }

    public function testGetUserId()
    {
        $p = new Player($this->playerName(), Side::WHITE, $this->gameId(),  false, $this->userId());
        $this->assertEquals($this->userId(), $p->getUserId());
    }

    public function testIsHuman()
    {
        $p = new Player($this->playerName(), Side::WHITE, $this->gameId());
        $this->assertFalse($p->isRobot());
    }

    public function testIsRobot()
    {
        $p = new Player($this->playerName(), Side::WHITE, $this->gameId(), true);
        $this->assertTrue($p->isRobot());
    }

    public function testIsWhite()
    {
        $p = new Player($this->playerName(), Side::WHITE, $this->gameId());
        $this->assertTrue($p->isWhite());
    }

    public function testIsBlack()
    {
        $p = new Player($this->playerName(), Side::BLACK, $this->gameId());
        $this->assertTrue($p->isBlack());
    }

    public function testGetSide()
    {
        $p = new Player($this->playerName(), Side::WHITE, $this->gameId());
        $this->assertEquals(Side::WHITE, $p->getSide());
    }

    private static function playerName(): string
    {
        return 'Koitus';
    }

    private static function userId(): int
    {
        return 1;
    }

    private static function gameId(): int
    {
        return 2;
    }
}