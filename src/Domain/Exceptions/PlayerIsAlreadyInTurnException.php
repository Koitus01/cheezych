<?php

namespace App\Domain\Exceptions;

use Exception;

class PlayerIsAlreadyInTurnException extends Exception
{
    protected $message = 'This player is already in turn';

}