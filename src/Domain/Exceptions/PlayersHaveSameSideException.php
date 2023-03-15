<?php

namespace App\Domain\Exceptions;

use Exception;

class PlayersHaveSameSideException extends Exception
{
    protected $message = 'Players are on the same side';
}