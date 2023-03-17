<?php

namespace App\Application\DTO;

readonly class CoordinatesDTO
{
    /**
     * @param int $x
     * @param int $y
     */
    public function __construct(
        public int $x,
        public int $y,
    ) {}
}