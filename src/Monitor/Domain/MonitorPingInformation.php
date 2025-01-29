<?php

namespace MarioDevv\Uptime\Monitor\Domain;

class MonitorPingInformation
{

    private int $state;
    private float $responseTime;

    public function __construct(int $state, float $responseTime)
    {
        $this->state        = $state;
        $this->responseTime = $responseTime;
    }

    public function state(): int
    {
        return $this->state;
    }

    public function responseTime(): float
    {
        return $this->responseTime;
    }

}
