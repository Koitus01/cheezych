<?php

namespace App\Domain;

use App\Domain\Enums\GameStatus;

class Game
{
    public readonly int $id;
    private Board $board;
    /**
     * @var Player[]
     */
    private array $players;
    private GameStatus $status;
    private Player $currentTurn;

    /**
     * @return Board
     */
    public function getBoard(): Board
    {
        return $this->board;
    }

    /**
     * @param Board $board
     */
    public function setBoard(Board $board): void
    {
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
     * @param array $players
     */
    public function setPlayers(array $players): void
    {
        $this->players = $players;
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
     * @param Player $currentTurn
     */
    public function setCurrentTurn(Player $currentTurn): void
    {
        $this->currentTurn = $currentTurn;
    }
}