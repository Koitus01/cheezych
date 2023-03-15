<?php

namespace App\Domain;

use App\Domain\Enums\GameResult;
use App\Domain\Enums\GameStatus;
use App\Domain\Exceptions\GameAlreadyFinishedException;
use App\Domain\Exceptions\NoPlayersInGameException;
use App\Domain\Exceptions\NotYourGameException;
use App\Domain\Exceptions\PlayerIsAlreadyInTurnException;
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
     * @return Player
     */
    public function getCurrentTurn(): Player
    {
        return $this->currentTurn;
    }

    /**
     * @param Player $currentTurnPlayer
     * @throws GameAlreadyFinishedException
     * @throws NoPlayersInGameException
     * @throws PlayerIsAlreadyInTurnException
     * @throws NotYourGameException
     */
    public function setCurrentTurn(Player $currentTurnPlayer): void
    {
        if ($currentTurnPlayer->getGameId() !== $this->id) {
            throw new NotYourGameException;
        }

        if (empty($this->players)) {
            throw new NoPlayersInGameException;
        }

        if ($this->result) {
            throw new GameAlreadyFinishedException;
        }

        if ($this->currentTurn === $currentTurnPlayer) {
            throw new PlayerIsAlreadyInTurnException;
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
     * @throws GameAlreadyFinishedException
     */
    public function setResult(GameResult $result): void
    {
        if ($this->result) {
            throw new GameAlreadyFinishedException;
        }
        $this->result = $result;
    }
}