<?php

namespace App\Tests\Integration\Application\UseCase;

use App\Application\DTO\CoordinatesDTO;
use App\Application\UseCase\MovePiece;
use App\Domain\Entity\Board;
use App\Domain\Entity\Game;
use App\Domain\Enums\GameStatus;
use App\Domain\Exceptions\UnknownYCoordinateException;
use App\Infrastructure\Repository\GameRepository;
use Generator;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

class MovePieceTest extends TestCase
{
    public function testExecute()
    {
        $gameModel = $this->createValidCleanGame();
        $repositoryMock = $this->createGameRepositoryMock($gameModel);
        $mp = new MovePiece($repositoryMock);
        $result = $mp->execute(1, new CoordinatesDTO(2, 1), new CoordinatesDTO(3, 1));

        $this->assertTrue($result);
    }

    public function testExecuteWithUnknownCoordinatesWillFail()
    {
        $this->expectException(UnknownYCoordinateException::class);

        $gameModel = $this->createValidCleanGame();
        $repositoryMock = $this->createGameRepositoryMock($gameModel);
        $mp = new MovePiece($repositoryMock);
        $mp->execute(1, new CoordinatesDTO(25, 1), new CoordinatesDTO(3, 1));
    }

    public function testExecuteWithNoMovementReturnFalse()
    {
        $gameModel = $this->createValidCleanGame();
        $repositoryMock = $this->createGameRepositoryMock($gameModel);
        $mp = new MovePiece($repositoryMock);
        $result = $mp->execute(1, new CoordinatesDTO(2, 1), new CoordinatesDTO(2, 1));

        $this->assertFalse($result);
    }

    public function testExecuteWithNoPieceFromReturnFalse()
    {
        $gameModel = $this->createValidCleanGame();
        $repositoryMock = $this->createGameRepositoryMock($gameModel);
        $mp = new MovePiece($repositoryMock);
        $result = $mp->execute(1, new CoordinatesDTO(5, 5), new CoordinatesDTO(2, 1));

        $this->assertFalse($result);
    }

    public function testExecuteInvalidMovementReturnFalse()
    {
        $gameModel = $this->createValidCleanGame();
        $repositoryMock = $this->createGameRepositoryMock($gameModel);
        $mp = new MovePiece($repositoryMock);
        $result = $mp->execute(1, new CoordinatesDTO(2, 1), new CoordinatesDTO(3, 2));

        $this->assertFalse($result);
    }

    public function testExecuteWithStepOnAlieReturnFalse()
    {
        $gameModel = $this->createValidCleanGame();
        $repositoryMock = $this->createGameRepositoryMock($gameModel);
        $mp = new MovePiece($repositoryMock);
        $result = $mp->execute(1, new CoordinatesDTO(1, 1), new CoordinatesDTO(2, 1));

        $this->assertFalse($result);
    }

    public function testExecuteInvalidCaptureReturnFalse()
    {
        $gameModel = $this->createValidCleanGame();
        $repositoryMock = $this->createGameRepositoryMock($gameModel);
        $mp = new MovePiece($repositoryMock);
        $result = $mp->execute(1, new CoordinatesDTO(2, 1), new CoordinatesDTO(7, 1));

        $this->assertFalse($result);
    }

    /**
     * @dataProvider provideInterferingMoves
     */
    public function testExecuteInterferingMovesReturnFalse()
    {
        $gameModel = $this->createValidCleanGame();
        $repositoryMock = $this->createGameRepositoryMock($gameModel);
        $mp = new MovePiece($repositoryMock);
        $result = $mp->execute(1, new CoordinatesDTO(1, 1), new CoordinatesDTO(3, 1));

        $this->assertFalse($result);
    }

    private static function createValidCleanGame(): Game
    {
        $gameModel = new Game(1);
        $boardModel = new Board();
        $boardModel->reset();
        $gameModel->setStatus(GameStatus::ACTIVE);
        $gameModel->setBoard($boardModel);
        return $gameModel;
    }

    private function createGameRepositoryMock(Game $gameModel): Stub|GameRepository
    {
        $repositoryMock = $this->createStub(GameRepository::class);
        $repositoryMock->method('findById')->willReturn($gameModel);
        return $repositoryMock;
    }

    public function provideInterferingMoves(): Generator
    {
        yield 'coordinates: 1, 2, 1, 25' => [
            [
                'yFrom' => 1,
                'xFrom' => 2,
                'yTo' => 1,
                'xTo' => 25
            ]
        ];
    }
}