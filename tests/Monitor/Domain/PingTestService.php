<?php

namespace MarioDevv\Uptime\Tests\Monitor\Domain;

use DateTimeImmutable;
use MarioDevv\Uptime\Monitor\Domain\MonitorPingInformation;
use MarioDevv\Uptime\Monitor\Domain\MonitorPingService;
use MarioDevv\Uptime\Monitor\Domain\MonitorTimeOut;
use MarioDevv\Uptime\Monitor\Domain\MonitorUrl;

class PingTestService implements MonitorPingService
{
    public int $httpStatusCode;
    public float $responseTime;

    public function __construct(int $httpStatusCode, float $responseTime)
    {
        $this->httpStatusCode = $httpStatusCode;
        $this->responseTime   = $responseTime;
    }

    public function ping(MonitorUrl $url, MonitorTimeOut $timeout): MonitorPingInformation
    {
        return new MonitorPingInformation(
            $this->httpStatusCode,
            $this->responseTime,
            DateTimeImmutable::createFromFormat('Y-m-d', date('Y-m-d')),
        );
    }


}
