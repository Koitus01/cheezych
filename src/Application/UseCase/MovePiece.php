<?php

namespace App\Application\UseCase;

use App\Application\DTO\CoordinatesDTO;
use App\Domain\Entity\Pieces\AbstractPiece;
use App\Domain\Entity\Square;
use App\Domain\Exceptions\UnknownXCoordinateException;
use App\Domain\Exceptions\UnknownYCoordinateException;
use App\Domain\Repository\GameRepositoryInterface;
use Exception;

class MovePiece
{
    private GameRepositoryInterface $gameRepository;
    private ?AbstractPiece $pieceFrom;
    private ?AbstractPiece $pieceTo;
    private Square $squareFrom;
    private Square $squareTo;

    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }


    /**
     * @throws UnknownXCoordinateException
     * @throws UnknownYCoordinateException
     */
    public function execute(int $gameId, CoordinatesDTO $moveFrom, CoordinatesDTO $moveTo)
    {
        $game = $this->gameRepository->findById($gameId);
        $board = $game->getBoard();

        $this->squareFrom = $board->getSquare($moveFrom->y, $moveFrom->x);
        $this->squareTo = $board->getSquare($moveTo->y, $moveTo->x);
        $this->pieceFrom = $this->squareFrom->getPiece();
        $this->pieceTo = $this->squareTo->getPiece();

        if ($moveFrom->y === $moveTo->y && $moveFrom->x === $moveTo->x) {
            return false;
        }

        if (!$this->validateMovement()) {
            return false;
        }

        #if ()

        return true;

    }

    private function validateMovement(): bool
    {


        #cannot put the piece to square with same color piece
        if ($this->pieceFrom->side === $this->pieceTo->side) {
            return false;
        }

        if (!$this->pieceFrom->isValidMovement(
            $this->squareFrom->y,
            $this->squareFrom->x,
            $this->squareTo->y,
            $this->squareTo->x
        )
        ) {
            return false;
        }

        return true;
    }

}