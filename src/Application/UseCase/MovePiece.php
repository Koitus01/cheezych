<?php

namespace App\Application\UseCase;

use App\Application\DTO\CoordinatesDTO;
use App\Domain\DTO\MovementCoordinatesDTO;
use App\Domain\Entity\Board;
use App\Domain\Entity\Pieces\AbstractPiece;
use App\Domain\Entity\Square;
use App\Domain\Enums\PieceName;
use App\Domain\Exceptions\UnknownXCoordinateException;
use App\Domain\Exceptions\UnknownYCoordinateException;
use App\Domain\Repository\GameRepositoryInterface;

class MovePiece
{
    public const COORDINATES_NOT_CHANGED_ERROR = 'Coordinates not changed';
    public const EMPTY_FROM_SQUARE_ERROR = 'From square does not contain piece';
    public const INVALID_MOVEMENT_ERROR = 'Invalid movement for this piece';
    public const INVALID_CAPTURE_ERROR = 'Invalid capture movement';
    public const MOVE_ON_SAME_COLOR_PIECE_ERROR = 'From and to squares have same color pieces';
    public const MOVE_HAVE_INTERSECTION_PIECES = 'Movement have intersections';

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
    private Board $board;

    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }


    /**
     * TODO: move validation to another class?? Error consts to separate file (m.b enum)?
     * @throws UnknownXCoordinateException
     * @throws UnknownYCoordinateException
     */
    public function execute(int $gameId, CoordinatesDTO $moveFrom, CoordinatesDTO $moveTo, &$errorMessage = '')
    {
        $game = $this->gameRepository->findById($gameId);
        $this->board = $game->getBoard();

        $this->squareFrom = $this->board->getSquare($moveFrom->x, $moveFrom->y);
        $this->squareTo = $this->board->getSquare($moveTo->x, $moveTo->y);
        $this->squares = $this->board->getSquares();
        $this->pieceFrom = $this->squareFrom->getPiece();
        $this->pieceTo = $this->squareTo->getPiece();
        $this->movementCoordinatesDTO = new MovementCoordinatesDTO(
            $this->squareFrom->x,
            $this->squareFrom->y,
            $this->squareTo->x,
            $this->squareTo->y
        );

        if ($moveFrom->y === $moveTo->y && $moveFrom->x === $moveTo->x) {
            $errorMessage = self::COORDINATES_NOT_CHANGED_ERROR;
            return false;
        }

        if (!$this->pieceFrom) {
            $errorMessage = self::EMPTY_FROM_SQUARE_ERROR;
            return false;
        }

        #if there is no piece on target square, we validate movement
        if (!$this->pieceTo && !$this->validateMovement()) {
            $errorMessage = self::INVALID_MOVEMENT_ERROR;
            return false;
        }

        #if there is enemy piece on target square, we validate capture
        if ($this->pieceTo && $this->pieceFrom->getSide() !== $this->pieceTo->getSide() && !$this->validateCapture()) {
            $errorMessage = self::INVALID_CAPTURE_ERROR;
            return false;
        }

        #if there is allied piece on target square, we have no validate
        if ($this->pieceFrom->getSide() === $this->pieceTo?->getSide()) {
            $errorMessage = self::MOVE_ON_SAME_COLOR_PIECE_ERROR;
            return false;
        }

        if (!$this->validateIntersections()) {
            $errorMessage = self::MOVE_HAVE_INTERSECTION_PIECES;
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

    private function validateIntersections(): bool
    {
        #no validate for knight, because he can step over pieces
        if ($this->pieceFrom->getName() === PieceName::KNIGHT) {
            return true;
        }



        foreach (range($this->squareFrom->y, $this->squareTo->y) as $key => $y) {
            if ($key === 0) {
                continue;
            }
            $square = $this->board->getSquare($this->squareFrom->x, $y);
            if ($square->getPiece()) {
                return false;
            }
        }

        foreach (range($this->squareFrom->x, $this->squareTo->x) as $key => $x) {
            #skipping first movement
            if ($key === 0) {
                continue;
            }
            $square = $this->board->getSquare($this->squareFrom->y, $x);
            if ($square->getPiece()) {
                return false;
            }
        }
/*        for ($yFrom; $yFrom !== $yTo; $yFrom++) {

        }*/


        return true;
    }
}