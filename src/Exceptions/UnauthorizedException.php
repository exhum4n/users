<?php

declare(strict_types=1);

namespace Exhum4n\Users\Exceptions;

use Exception;
use Throwable;

class UnauthorizedException extends Exception
{
    public function __construct($message = '', Throwable $previous = null)
    {
        parent::__construct($message, 401, $previous);
    }
}