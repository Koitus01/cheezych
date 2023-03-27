<?php

namespace App\Domain\Exceptions;

use Exception;

class NotYourGameException extends Exception
{
    protected $message = 'This player is not belong to this game';

}