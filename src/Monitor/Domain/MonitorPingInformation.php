<?php

namespace MarioDevv\Uptime\Monitor\Domain;

use DateTimeImmutable;

class MonitorPingInformation
{

    private int                $httpStatusCode;
    private float              $responseTime;
    private ?DateTimeImmutable $sslExpiration;

    public function __construct(
        int                $httpStatusCode,
        float              $responseTime,
        ?DateTimeImmutable $sslExpiration
    )
    {
        $this->httpStatusCode = $httpStatusCode;
        $this->responseTime   = $responseTime;
        $this->sslExpiration  = $sslExpiration;
    }

    public function httpStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    public function responseTime(): float
    {
        return $this->responseTime;
    }

    public function sslExpiration(): ?DateTimeImmutable
    {
        return $this->sslExpiration;
    }

}
