<?php
declare(strict_types=1);

namespace MarioDevv\Uptime\Monitor\Domain;

use DateTimeImmutable;

class MonitorHistory
{

    private int $surrogateId;

    private int $httpStatusCode;
    private DateTimeImmutable $pingedAt;
    private MonitorHistoryState $state;
    private float $responseTime;

    public function __construct(

        int                 $httpStatusCode,
        DateTimeImmutable   $pingedAt,
        MonitorHistoryState $state,
        float               $responseTime
    )
    {
        $this->httpStatusCode = $httpStatusCode;
        $this->pingedAt       = $pingedAt;
        $this->state          = $state;
        $this->responseTime   = $responseTime;
    }

    public function httpStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    public function pingedAt(): DateTimeImmutable
    {
        return $this->pingedAt;
    }

    public function state(): MonitorHistoryState
    {
        return $this->state;
    }

    public function responseTime(): float
    {
        return $this->responseTime;
    }

    public function isFailure(): bool
    {
        return $this->httpStatusCode >= 400;
    }

    public static function create(
        int    $statusCode,
        string $pingedAt,
        int    $state,
        float  $responseTime
    ): MonitorHistory
    {
        return new self(
            $statusCode,
            new DateTimeImmutable($pingedAt),
            new MonitorHistoryState($state),
            $responseTime
        );
    }

    public static function fromMonitor(Monitor $monitor, int $statusCode, float $responseTime): self
    {
        return new self(
            $statusCode,
            $monitor->lastCheck()->value(),
            new MonitorHistoryState($monitor->state()->value()),
            $responseTime
        );
    }

}
