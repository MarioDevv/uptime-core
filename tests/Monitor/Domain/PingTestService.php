<?php

namespace MarioDevv\Uptime\Tests\Monitor\Domain;

use MarioDevv\Uptime\Monitor\Domain\MonitorPingInformation;
use MarioDevv\Uptime\Monitor\Domain\MonitorPingService;
use MarioDevv\Uptime\Monitor\Domain\MonitorTimeOut;
use MarioDevv\Uptime\Monitor\Domain\MonitorUrl;

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
