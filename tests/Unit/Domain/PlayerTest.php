<?php

namespace App\Tests\Unit\Domain;

use App\Domain\Enums\Side;
use App\Domain\Player;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testGetName()
    {
        $p = new Player($this->name(), Side::WHITE);
        $this->assertEquals($this->name(), $p->getName());

    }

    public function testGetUserId()
    {
        $p = new Player($this->name(), Side::WHITE,  false, $this->userId());
        $this->assertEquals($this->userId(), $p->getUserId());
    }

    public function testIsHuman()
    {
        $p = new Player($this->name(), Side::WHITE);
        $this->assertFalse($p->isRobot());
    }

    public function testIsRobot()
    {
        $p = new Player($this->name(), Side::WHITE, true);
        $this->assertTrue($p->isRobot());
    }

    public function testIsWhite()
    {
        $p = new Player($this->name(), Side::WHITE);
        $this->assertTrue($p->isWhite());
    }

    public function testIsBlack()
    {
        $p = new Player($this->name(), Side::BLACK);
        $this->assertTrue($p->isBlack());
    }

    public function testGetSide()
    {
        $p = new Player($this->name(), Side::WHITE);
        $this->assertEquals(Side::WHITE, $p->getSide());
    }

    private static function name(): string
    {
        return 'Koitus';
    }

    private static function userId(): int
    {
        return 1;
    }
}