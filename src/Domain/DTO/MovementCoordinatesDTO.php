<?php

namespace App\Domain\DTO;

readonly class MovementCoordinatesDTO
{
    public int $xFrom;
    public int $yFrom;
    public int $xTo;
    public int $yTo;

    /**
     * @param int $xFrom
     * @param int $yFrom
     * @param int $xTo
     * @param int $yTo
     */
    public function __construct(int $xFrom, int $yFrom, int $xTo, int $yTo)
    {
        $this->xFrom = $xFrom;
        $this->yFrom = $yFrom;
        $this->xTo = $xTo;
        $this->yTo = $yTo;
    }
}