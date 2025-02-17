<?php

namespace MarioDevv\Uptime\Monitoring\Domain;

interface MonitorPingService
{
    public function ping(MonitorUrl $url, MonitorTimeOut $timeout): MonitorPingInformation;
}
