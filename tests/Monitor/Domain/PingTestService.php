<?php

namespace Mario\Uptime\Tests\Monitor\Domain;

use Mario\Uptime\Monitor\Domain\MonitorPingInformation;
use Mario\Uptime\Monitor\Domain\MonitorPingService;
use Mario\Uptime\Monitor\Domain\MonitorTimeOut;
use Mario\Uptime\Monitor\Domain\MonitorUrl;

class PingTestService implements MonitorPingService
{
    public int $state;
    public float $responseTime;

    public function __construct(int $state, float $responseTime)
    {
        $this->state        = $state;
        $this->responseTime = $responseTime;
    }

    public function ping(MonitorUrl $url, MonitorTimeOut $timeout): MonitorPingInformation
    {
        return new MonitorPingInformation($this->state, $this->responseTime);
    }


}
