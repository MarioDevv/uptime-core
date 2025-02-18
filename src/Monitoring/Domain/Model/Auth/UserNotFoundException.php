<?php

namespace MarioDevv\Uptime\Monitoring\Domain\Model\Auth;

use MarioDevv\Uptime\Monitoring\Domain\DomainException;

class UserNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct("User not found");
    }
}
