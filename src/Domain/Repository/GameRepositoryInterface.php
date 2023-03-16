<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Game;

interface GameRepositoryInterface
{
    public function findById(int $id): Game;

}