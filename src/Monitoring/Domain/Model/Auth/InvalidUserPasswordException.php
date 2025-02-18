<?php

namespace MarioDevv\Uptime\Monitoring\Domain\Model\Auth;

use MarioDevv\Uptime\Monitoring\Domain\DomainException;

class InvalidUserPasswordException extends DomainException
{

    public function __construct()
    {
        parent::__construct("Your password must be at least 8 characters long,
         include at least one lowercase letter, one uppercase letter, and one digit,
          and must not contain any spaces.");
    }
}
