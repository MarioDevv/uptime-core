<?php

namespace MarioDevv\Uptime\Monitoring\Application;

use MarioDevv\Uptime\Monitoring\Domain\Monitor;

interface MonitorAssemblerInterface
{

    public function assemble(Monitor $monitor, ...$args): mixed;

}
