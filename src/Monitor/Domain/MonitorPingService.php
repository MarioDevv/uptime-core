<?php

namespace Mario\Uptime\Monitor\Domain;

interface MonitorPingService
{
    public function ping(MonitorUrl $url, MonitorTimeOut $timeout): MonitorPingInformation;
}
