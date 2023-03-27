<?php

namespace App\Domain\Exceptions;

class UnknownXCoordinateException extends \Exception
{
    protected $message = 'Unknown X coordinate';
}