<?php

namespace MarioDevv\Uptime\Monitoring\Domain\Model\Auth;

use MarioDevv\Uptime\Shared\Domain\DomainException;

class InvalidUserEmailException extends DomainException
{
    public function __construct(string $email)
    {
        parent::__construct("The email <<$email>> is not valid");
    }
}