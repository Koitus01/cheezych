<?php

namespace App\Tests\Unit\Domain;

use App\Domain\Entity\Board;
use App\Domain\Entity\Game;
use App\Domain\Entity\Player;
use App\Domain\Enums\GameResult;
use App\Domain\Enums\GameStatus;
use App\Domain\Enums\Side;
use App\Domain\Exceptions\PlayersHaveSameSideException;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testSetBoard()
    {
        $g = new Game($this->gameId());
        $g->setBoard(new Board());
        $this->assertNotEmpty($g->getBoard());
    }

    public function testSetPlayers()
    {
        $g = new Game($this->gameId());
        $player1 = new Player($this->player1Name(), Side::WHITE, $this->gameId());
        $player2 = new Player($this->player2Name(), Side::BLACK, $this->gameId());
        $g->setPlayers($player1, $player2);
        $this->assertEquals([$player1, $player2], $g->getPlayers());
    }

    public function testCannotSetPlayersWithSameSide()
    {
        $this->expectException(PlayersHaveSameSideException::class);

        $g = new Game($this->gameId());
        $player1 = new Player($this->player1Name(), Side::WHITE, $this->gameId());
        $player2 = new Player($this->player2Name(), Side::WHITE, $this->gameId());
        $g->setPlayers($player1, $player2);
    }

    public function testSetStatus()
    {
        $g = new Game($this->gameId());
        $g->setStatus(GameStatus::FINISHED);
        $this->assertEquals(GameStatus::FINISHED, $g->getStatus());
    }

    public function testSetResult()
    {
        $g = new Game($this->gameId());
        $g->setResult(GameResult::WHITE_WIN);

        $this->assertEquals(GameResult::WHITE_WIN, $g->getResult());
    }

    public function testCannotSetResultSecondTime()
    {
        $g = new Game($this->gameId());
        $g->setResult(GameResult::BLACK_WIN);
        $g->setResult(GameResult::WHITE_WIN);

        $this->assertEquals(GameResult::BLACK_WIN, $g->getResult());
    }

    public function testSetCurrentTurn()
    {
        $g = new Game($this->gameId());
        $player1 = new Player($this->player1Name(), Side::WHITE, $this->gameId());
        $player2 = new Player($this->player2Name(), Side::BLACK, $this->gameId());
        $g->setPlayers($player1, $player2);
        $g->setCurrentTurn($player1);
        $this->assertEquals($player1, $g->getCurrentTurn());
    }

    #TODO: подумать над необходимость этого теста
    public function testCannotSetTurnOnTheSamePlayer()
    {
        $g = new Game($this->gameId());
        $player1 = new Player($this->player1Name(), Side::WHITE, $this->gameId());
        $player2 = new Player($this->player2Name(), Side::BLACK, $this->gameId());
        $g->setPlayers($player1, $player2);
        $g->setCurrentTurn($player1);
        $g->setCurrentTurn($player1);

        $this->assertEquals($player1, $g->getCurrentTurn());
    }

    public function testSetCurrentTurnWithNoPlayersGameWillFail()
    {
        $g = new Game($this->gameId());
        $player1 = new Player($this->player1Name(), Side::WHITE, $this->gameId());
        $g->setCurrentTurn($player1);
        $this->assertNull($g->getCurrentTurn());
    }

    public function testSetCurrentTurnWithNonGamePlayerWillFail()
    {
        $g = new Game($this->gameId());
        $player1 = new Player($this->player1Name(), Side::WHITE, $this->gameId());
        $player2 = new Player($this->player2Name(), Side::BLACK, $this->gameId());
        $g->setPlayers($player1, $player2);
        $g->setCurrentTurn(new Player('Bibi', Side::WHITE, 2));

        $this->assertNull($g->getCurrentTurn());
    }

    private function gameId(): int
    {
        return 1;
    }

    private function player1Name(): string
    {
        return 'Pupu';
    }

    private function player2Name(): string
    {
        return 'Lulu';
    }
}