<?php

declare(strict_types=1);

namespace Exhum4n\Users\Exceptions;

use Exception;
use Throwable;

class VerificationException extends Exception
{
    public function __construct($message = 'Wrong verification code', $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
