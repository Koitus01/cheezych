<?php

namespace App\Domain\Pieces;

interface PiecesInterface
{
    /**
     * @return mixed
     */
    public function getMovementPattern();

    /**
     * @return mixed
     */
    public function getCapturePattern();

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @return mixed
     */
    public function getFeatures();


    /**
     * Может ли использоваться в рокировке
     * @return mixed
     */
    public function isCastling();

    public function isPromotionPossible();
}