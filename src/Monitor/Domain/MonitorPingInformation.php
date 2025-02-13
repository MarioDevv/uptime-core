<?php

namespace MarioDevv\Uptime\Monitor\Domain;

use DateTimeImmutable;

class MonitorPingInformation
{

    private int               $state;
    private float             $responseTime;
    private DateTimeImmutable $sslExpiration;

    public function __construct(int $state, float $responseTime, DateTimeImmutable $sslExpiration)
    {
        $this->state         = $state;
        $this->responseTime  = $responseTime;
        $this->sslExpiration = $sslExpiration;
    }

    public function state(): int
    {
        return $this->state;
    }

    public function responseTime(): float
    {
        return $this->responseTime;
    }

    public function sslExpiration(): DateTimeImmutable
    {
        return $this->sslExpiration;
    }

}
