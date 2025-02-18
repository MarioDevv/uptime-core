<?php

namespace MarioDevv\Uptime\Monitoring\Domain\Model\Auth;

use MarioDevv\Uptime\Monitoring\Domain\DomainException;

class LoginFailedException extends DomainException
{
    public function __construct()
    {
        parent::__construct("Error while login");
    }
}
