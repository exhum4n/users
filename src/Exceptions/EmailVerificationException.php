<?php

namespace Exhum4n\Users\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class EmailVerificationException extends Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = Response::HTTP_NOT_FOUND, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
