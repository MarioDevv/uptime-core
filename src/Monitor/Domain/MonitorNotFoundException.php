<?php

namespace MarioDevv\Uptime\Monitor\Domain;

use MarioDevv\Uptime\Shared\Domain\DomainException;

class MonitorNotFoundException extends DomainException
{

    public function __construct(int $id)
    {
        parent::__construct("Monitor with id <<$id>> not found");
    }
}