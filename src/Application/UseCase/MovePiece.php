<?php

namespace App\Application\UseCase;

use App\Application\DTO\CoordinatesDTO;
use App\Domain\DTO\MovementCoordinatesDTO;
use App\Domain\Entity\Pieces\AbstractPiece;
use App\Domain\Entity\Square;
use App\Domain\Enums\PieceName;
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
    /**
     * @var Square[]
     */
    private array $squares;
    private MovementCoordinatesDTO $movementCoordinatesDTO;

    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }


    /**
     * TODO: move validate to another class??
     * @throws UnknownXCoordinateException
     * @throws UnknownYCoordinateException
     */
    public function execute(int $gameId, CoordinatesDTO $moveFrom, CoordinatesDTO $moveTo)
    {
        $game = $this->gameRepository->findById($gameId);
        $board = $game->getBoard();

        $this->squareFrom = $board->getSquare($moveFrom->y, $moveFrom->x);
        $this->squareTo = $board->getSquare($moveTo->y, $moveTo->x);
        $this->squares = $board->getSquares();
        $this->pieceFrom = $this->squareFrom->getPiece();
        $this->pieceTo = $this->squareTo->getPiece();
        $this->movementCoordinatesDTO = new MovementCoordinatesDTO(
            $this->squareFrom->x,
            $this->squareFrom->y,
            $this->squareTo->x,
            $this->squareTo->y
        );

        if ($moveFrom->y === $moveTo->y && $moveFrom->x === $moveTo->x) {
            return false;
        }

        if (!$this->pieceFrom) {
            return false;
        }

        #if there is no piece on target square, we validate movement
        if (!$this->pieceTo && !$this->validateMovement()) {
            return false;
        }

        #if there is enemy piece on target square, we validate capture
        if ($this->pieceTo && $this->pieceFrom->getSide() !== $this->pieceTo->getSide() && !$this->validateCapture()) {
            return false;
        }

        #if there is allied piece on target square, we have no validate
        if ($this->pieceFrom->getSide() === $this->pieceTo?->getSide()) {
            return false;
        }

        if (!$this->validateInterfering()) {
            return false;
        }

        return true;
    }

    private function validateMovement(): bool
    {
        return $this->pieceFrom->isValidMovement($this->movementCoordinatesDTO);
    }

    private function validateCapture(): bool
    {
        return $this->pieceFrom->isValidCapture($this->movementCoordinatesDTO);
    }

    private function validateInterfering(): bool
    {
        #no validate for knight, because he can step over pieces
        if ($this->pieceFrom->getName() === PieceName::KNIGHT) {
            return true;
        }

        $xDiff = abs($this->squareFrom->x - $this->squareTo->x);
        $yDiff = abs($this->squareFrom->y - $this->squareTo->y);

        #catch vertical move
        if ($yDiff > 0 && $xDiff === 0) {
            for ($i = $this->squareFrom->y + 1; $i <= $this->squareTo->y; $i++) {
                if (isset($this->squares[$i][$this->squareFrom->x])) {
                    return false;
                }
            }
            for ($i = $this->squareTo->y + 1; $i <= $this->squareFrom->y; $i++) {
                if (isset($this->squares[$i][$this->squareFrom->x])) {
                    return false;
                }
            }
        }

        #catch horizontal move
        if ($xDiff > 0 && $yDiff === 0) {
            for ($i = $this->squareFrom->x + 1; $i <= $this->squareTo->x; $i++) {
                if (isset($this->squares[$this->squareFrom->y][$i])) {
                    return false;
                }
            }
            for ($i = $this->squareTo->x + 1; $i <= $this->squareFrom->x; $i++) {
                if (isset($this->squares[$this->squareFrom->y][$i])) {
                    return false;
                }
            }
        }

        return true;
    }
}