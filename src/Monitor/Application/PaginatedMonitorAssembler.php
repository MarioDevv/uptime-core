<?php

namespace MarioDevv\Uptime\Monitor\Application;

use MarioDevv\Uptime\Monitor\Domain\Monitor;

class PaginatedMonitorAssembler implements MonitorAssemblerInterface
{

    public function assemble(Monitor $monitor, ...$args): PaginatedMonitorDTO
    {
        return new PaginatedMonitorDTO($monitor, ...$args);
    }

}
