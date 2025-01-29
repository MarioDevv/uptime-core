<?php
declare(strict_types=1);

namespace MarioDevv\Uptime\Monitor\Domain;

class MonitorHistory
{

    private int $surrogateId;

    private int $monitorId;
    private MonitorHistoryPingedAt $pingedAt;
    private MonitorHistoryState $state;
    private float $responseTime;

    public function __construct(
        int                    $monitorId,
        MonitorHistoryPingedAt $pingedAt,
        MonitorHistoryState    $state,
        float                  $responseTime
    )
    {
        $this->monitorId    = $monitorId;
        $this->pingedAt     = $pingedAt;
        $this->state        = $state;
        $this->responseTime = $responseTime;
    }

    public function monitorId(): int
    {
        return $this->monitorId;
    }

    public function pingedAt(): MonitorHistoryPingedAt
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

    public static function create(
        int    $monitorId,
        string $pingedAt,
        int    $state,
        float  $responseTime
    ): MonitorHistory
    {
        return new self(
            $monitorId,
            new MonitorHistoryPingedAt($pingedAt),
            new MonitorHistoryState($state),
            $responseTime
        );
    }

    public static function fromMonitor(Monitor $monitor, float $responseTime): self
    {
        return new self(
            $monitor->id(),
            new MonitorHistoryPingedAt($monitor->lastCheck()->value()),
            new MonitorHistoryState($monitor->state()->value()),
            $responseTime
        );
    }

}
