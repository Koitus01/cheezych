<?php

namespace App\Domain\Exceptions;

use Exception;

class GameAlreadyFinishedException extends Exception
{
    protected $message = 'The game is already over. You cannot change its state';

}