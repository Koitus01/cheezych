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
    private Player $whitePlayer;
    private Player $blackPlayer;
    private GameStatus $status;
    private Player $winner;
    private Player $loser;
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
     * @return Player
     */
    public function getWhitePlayer(): Player
    {
        return $this->whitePlayer;
    }

    /**
     * @param Player $whitePlayer
     */
    public function setWhitePlayer(Player $whitePlayer): void
    {
        $this->whitePlayer = $whitePlayer;
    }

    /**
     * @return Player
     */
    public function getBlackPlayer(): Player
    {
        return $this->blackPlayer;
    }

    /**
     * @param Player $blackPlayer
     */
    public function setBlackPlayer(Player $blackPlayer): void
    {
        $this->blackPlayer = $blackPlayer;
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
    public function getWinner(): Player
    {
        return $this->winner;
    }

    /**
     * @param Player $winner
     */
    public function setWinner(Player $winner): void
    {
        $this->winner = $winner;
    }

    /**
     * @return Player
     */
    public function getLoser(): Player
    {
        return $this->loser;
    }

    /**
     * @param Player $loser
     */
    public function setLoser(Player $loser): void
    {
        $this->loser = $loser;
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