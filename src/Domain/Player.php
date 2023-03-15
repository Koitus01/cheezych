<?php

namespace App\Domain;

use App\Domain\Enums\Side;

class Player
{
    private string $name;
    private bool $isRobot;
    private ?int $userId;
    private Side $side;
    private int $gameId;

    /**
     * @param string $name
     * @param Side $side
     * @param int $gameId
     * @param bool $isRobot
     * @param int|null $userId
     */
    public function __construct(string $name, Side $side,  int $gameId, bool $isRobot = false, ?int $userId = null)
    {
        $this->name = $name;
        $this->side = $side;
        $this->gameId = $gameId;
        $this->isRobot = $isRobot;
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isRobot(): bool
    {
        return $this->isRobot;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return Side
     */
    public function getSide(): Side
    {
        return $this->side;
    }

    /**
     * @return int
     */
    public function getGameId(): int
    {
        return $this->gameId;
    }

    public function isWhite(): bool
    {
        return $this->side === Side::WHITE;
    }

    public function isBlack(): bool
    {
        return $this->side === Side::BLACK;
    }
}