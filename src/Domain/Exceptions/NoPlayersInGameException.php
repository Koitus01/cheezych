<?php

namespace App\Domain\Exceptions;

use Exception;

class NoPlayersInGameException extends Exception
{
    protected $message = 'There are no players in game';
}