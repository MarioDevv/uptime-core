<?php

namespace MarioDevv\Uptime\Monitoring\Domain\Model\Monitor;

use MarioDevv\Uptime\Monitoring\Domain\DomainException;

class MonitorNotFoundException extends DomainException
{

    public function __construct(int $id)
    {
        parent::__construct("Monitor with id <<$id>> not found");
    }
}
