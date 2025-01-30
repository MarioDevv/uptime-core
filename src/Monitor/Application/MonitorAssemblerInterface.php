<?php

namespace MarioDevv\Uptime\Monitor\Application;

use MarioDevv\Uptime\Monitor\Domain\Monitor;

interface MonitorAssemblerInterface
{

    public function assemble(Monitor $monitor, ...$args): mixed;

}
