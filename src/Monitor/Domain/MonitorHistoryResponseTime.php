<?php

namespace MarioDevv\Uptime\Monitor\Domain;

class MonitorHistoryResponseTime
{

    private float $value;

    public function __construct(float $responseTime)
    {
        $this->value = $responseTime;
    }

    public function value(): float
    {
        return $this->value;
    }


}
