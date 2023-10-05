<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class InvalidActionException extends Exception
{
    public function __construct(public string $class)
    {
        parent::__construct("Invalid action: {$class}");
    }

    public function report()
    {
        Log::info("Invalid action: {$this->class}");
    }
}
