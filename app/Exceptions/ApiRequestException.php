<?php

namespace App\Exceptions;

use Exception;

class ApiRequestException extends Exception
{
    public function render($request, Exception $exception)
    {
        // todo: custom exception
    }
}
