<?php

declare(strict_types=1);

namespace Exhum4n\Users\Exceptions;

use Exception;
use Throwable;

class AuthException extends Exception
{
    public function __construct($message = '', $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
