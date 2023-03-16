<?php

namespace App\Domain\Entity;

use App\Domain\Enums\GameResult;
use App\Domain\Enums\GameStatus;
use App\Domain\Exceptions\GameAlreadyFinishedException;
use App\Domain\Exceptions\PlayersHaveSameSideException;

class Game
{
    public readonly int $id;
    private Board $board;
    /**
     * @var Player[]
     */
    private array $players;
    private GameStatus $status;
    private ?GameResult $result = null;
    private ?Player $currentTurn = null;

    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return Board
     */
    public function getBoard(): Board
    {
        return $this->board;
    }

    /**
     * @param Board $board
     * @throws GameAlreadyFinishedException
     */
    public function setBoard(Board $board): void
    {
        if ($this->result) {
            throw new GameAlreadyFinishedException;
        }

        $this->board = $board;
    }

    /**
     * @return array
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * @param Player $player1
     * @param Player $player2
     * @throws PlayersHaveSameSideException
     * @throws GameAlreadyFinishedException
     */
    public function setPlayers(Player $player1, Player $player2): void
    {
        if ($player1->getSide() === $player2->getSide()) {
            throw new PlayersHaveSameSideException;
        }

        if ($this->result) {
            throw new GameAlreadyFinishedException;
        }

        $this->players = [$player1, $player2];
    }

    /**
     * @return GameStatus
     */
    public function getStatus(): GameStatus
    {
        return $this->status;
    }

    /**
     * @param GameStatus $status
     */
    public function setStatus(GameStatus $status): void
    {
        $this->status = $status;
    }

    /**
     * @return Player|null
     */
    public function getCurrentTurn(): ?Player
    {
        return $this->currentTurn;
    }

    /**
     * @param Player $currentTurnPlayer
     * TODO: выкидывать ли эксепшены при зафейленных проверках?
     */
    public function setCurrentTurn(Player $currentTurnPlayer): void
    {
        if ($currentTurnPlayer->getGameId() !== $this->id) {
            return;
            #throw new NotYourGameException;
        }

        if (empty($this->players)) {
            return;
            #throw new NoPlayersInGameException;
        }

        if ($this->result) {
            return;
            #throw new GameAlreadyFinishedException;
        }

        if ($this->currentTurn === $currentTurnPlayer) {
            return;
            #throw new PlayerIsAlreadyInTurnException;
        }

        $this->currentTurn = $currentTurnPlayer;
    }

    /**
     * @return GameResult
     */
    public function getResult(): GameResult
    {
        return $this->result;
    }

    /**
     * @param GameResult $result
     */
    public function setResult(GameResult $result): void
    {
        if ($this->result) {
            return;
            #throw new GameAlreadyFinishedException;
        }
        $this->result = $result;
    }
}