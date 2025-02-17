<?php

namespace MarioDevv\Uptime\Monitoring\Domain\Model\Monitor;

interface MonitorNotifier
{
    public function notify(Monitor $monitor): void;
}