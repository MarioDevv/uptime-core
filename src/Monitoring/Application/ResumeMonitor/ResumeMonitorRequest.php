<?php

namespace MarioDevv\Uptime\Monitoring\Application\ResumeMonitor;

class ResumeMonitorRequest
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
