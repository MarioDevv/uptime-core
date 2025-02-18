<?php

namespace MarioDevv\Uptime\Monitoring\Domain\Model\Auth;

use MarioDevv\Uptime\Monitoring\Domain\DomainException;

class LogoutFailedException extends DomainException
{

    public function __construct()
    {
        parent::__construct("Error while logout");
    }
}
