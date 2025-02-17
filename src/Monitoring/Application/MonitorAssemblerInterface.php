<?php

namespace MarioDevv\Uptime\Monitoring\Application;

use MarioDevv\Uptime\Monitoring\Domain\Model\Monitor\Monitor;

interface MonitorAssemblerInterface
{

    public function assemble(Monitor $monitor, ...$args): mixed;

}
