<?php

namespace MarioDevv\Uptime\Monitor\Application;

use MarioDevv\Uptime\Monitor\Domain\Monitor;

class CompleteMonitorAssembler implements MonitorAssemblerInterface
{
    public function assemble(Monitor $monitor, ...$args): CompleteMonitorDTO
    {
        return new CompleteMonitorDTO($monitor, ...$args);
    }
}