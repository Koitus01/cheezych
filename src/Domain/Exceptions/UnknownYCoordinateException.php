<?php

namespace App\Domain\Exceptions;

class UnknownYCoordinateException extends \Exception
{
    protected $message = 'Unknown Y coordinate';
}