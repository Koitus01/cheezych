<?php

namespace App\Tests\Integration\Application\UseCase;

use App\Application\DTO\CoordinatesDTO;
use App\Application\UseCase\MovePiece;
use App\Domain\Entity\Board;
use App\Domain\Entity\Game;
use App\Domain\Enums\GameStatus;
use App\Infrastructure\Repository\GameRepository;
use PHPUnit\Framework\TestCase;

class MovePieceTest extends TestCase
{
    public function testExecute()
    {
        $gameModel = new Game(1);
        $boardModel = new Board();
        $boardModel->reset();
        $gameModel->setStatus(GameStatus::ACTIVE);
        $gameModel->setBoard($boardModel);
        $repositoryMock = $this->createStub(GameRepository::class);
        $repositoryMock->method('findById')->willReturn($gameModel);
        $mp = new MovePiece($repositoryMock);
        $result = $mp->execute(1, new CoordinatesDTO(1, 2), new CoordinatesDTO(2, 2));

        $this->assertTrue($result);
    }
}