<?php

namespace MarioDevv\Uptime\Monitoring\Domain\Model\Monitor;

interface MonitorPingService
{
    public function ping(MonitorUrl $url, MonitorTimeOut $timeout): MonitorPingInformation;
}
