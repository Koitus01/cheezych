<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Game;
use App\Domain\Repository\GameRepositoryInterface;

class GameRepository implements GameRepositoryInterface
{
    public function findById(int $id): Game
    {
        // TODO: Implement findById() method.
    }
}