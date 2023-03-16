<?php

namespace App\Application\UseCase;

use App\Application\DTO\CoordinatesDTO;
use App\Domain\Config\BoardConfig;
use App\Domain\Entity\Square;
use App\Domain\Repository\GameRepositoryInterface;

class MovePiece
{
    private GameRepositoryInterface $gameRepository;

    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function execute(int $gameId, CoordinatesDTO $moveFrom, CoordinatesDTO $moveTo)
    {
        $game = $this->gameRepository->findById($gameId);
        $board = $game->getBoard();

        $squareFrom = $board->getSquare($moveFrom->y, $moveFrom->x);
        $squareTo = $board->getSquare($moveTo->y, $moveTo->x);

        if (!$this->validateMovement($squareFrom, $squareTo)) {
            return false;
        }

        #TODO: think where to move these conditions
        if ($moveFrom->y > BoardConfig::MAX_COORDINATE || $moveTo->y > BoardConfig::MAX_COORDINATE) {
            return false;
        }
        if ($moveFrom->x < BoardConfig::MIN_COORDINATE || $moveTo->x < BoardConfig::MIN_COORDINATE) {
            return false;
        }

        if ($moveFrom->y === $moveTo->y && $moveFrom->x === $moveTo->x) {
            return false;
        }

        return true;

    }

    private function validateMovement(Square $squareFrom, Square $squareTo)
    {
        $pieceFrom = $squareFrom->getPiece();
        $pieceTo = $squareTo->getPiece();

        #cannot put the piece to square with same color piece
        if ($pieceFrom->side === $pieceTo->side) {
            return false;
        }

        if (!$pieceFrom->isValidMovement(
            $squareFrom->y,
            $squareFrom->x,
            $squareTo->y,
            $squareTo->x
        )
        ) {
            return false;
        }
    }

}