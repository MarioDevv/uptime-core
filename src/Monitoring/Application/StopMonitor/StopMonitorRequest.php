<?php

namespace MarioDevv\Uptime\Monitoring\Application\StopMonitor;

class StopMonitorRequest
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
