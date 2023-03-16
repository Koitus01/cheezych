<?php

namespace App\Application\UseCase;

use App\Application\DTO\CoordinatesDTO;
use App\Domain\Game;
use App\Domain\Pieces\AbstractPiece;
use App\Domain\Repository\GameRepositoryInterface;
use App\Domain\Square;

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
        #cannot put the piece to square with same color piece

    }

    private function validateMovement(Square $squareFrom, Square $squareTo)
    {
        $pieceFrom = $squareFrom->getPiece();
        $pieceTo = $squareTo->getPiece();

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