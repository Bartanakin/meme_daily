<?php

namespace Barta\MemeRetriever;

use LogicException;
use Throwable;

class MemeNotFoundException extends LogicException
{
    public function __construct(string $message = "Meme not found", int $code = 0, Throwable|null $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
