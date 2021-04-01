<?php

declare(strict_types=1);

namespace Exhum4n\Users\Exceptions;

use Exception;
use Throwable;

class UserNotFoundException extends Exception
{
    public function __construct($message = 'User not found', Throwable $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }
}
