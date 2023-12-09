<?php

namespace MalvikLab\IpApiClient\Exceptions;

use Exception;
use Rakit\Validation\ErrorBag;
use Throwable;

class ValidationException extends Exception
{
    private ErrorBag $errors;

    public function __construct(ErrorBag $errors, int $code = 0, ?Throwable $previous = null)
    {
        $this->errors = $errors;

        parent::__construct(json_encode($errors->toArray()), $code, $previous);
    }

    public function getErrors(): ErrorBag
    {
        return $this->errors;
    }
}