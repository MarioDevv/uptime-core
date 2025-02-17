<?php

namespace MarioDevv\Uptime\Monitoring\Application\Find;

class FindMonitorRequest
{

    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }

}