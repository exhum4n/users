<?php

namespace Exhum4n\Users\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UserChangeEmailException extends Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = '', $code = Response::HTTP_BAD_REQUEST, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
