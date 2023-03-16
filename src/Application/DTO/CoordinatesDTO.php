<?php

namespace App\Application\DTO;

readonly class CoordinatesDTO
{
    /**
     * @param int $y
     * @param int $x
     */
    public function __construct(
        public int $y,
        public int $x
    ) {}
}