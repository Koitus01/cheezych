<?php

namespace App\Domain\Repository;

use App\Domain\Game;

interface GameRepositoryInterface
{
    public function findById(int $id): Game;

}