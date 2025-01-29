<?php
declare(strict_types=1);
namespace Mario\Uptime\Monitor\Domain;

class MonitorHistory
{

    private int $surrogatedId;

    private int $monitorId;
    private MonitorHistoryPingedAt $pingedAt;
    private MonitorHistoryState $state;
    private MonitorHistoryResponseTime $responseTime;

    public function __construct(
        int                        $monitorId,
        MonitorHistoryPingedAt     $pingedAt,
        MonitorHistoryState        $state,
        MonitorHistoryResponseTime $responseTime
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

    public function responseTime(): MonitorHistoryResponseTime
    {
        return $this->responseTime;
    }

    public static function create(
        int    $id,
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
            new MonitorHistoryResponseTime($responseTime)
        );
    }

    public static function fromMonitor(Monitor $monitor, float $responseTime): self
    {
        return new self(
            $monitor->id(),
            new MonitorHistoryPingedAt($monitor->lastCheck()->value()),
            new MonitorHistoryState($monitor->state()->value()),
            new MonitorHistoryResponseTime($responseTime)
        );
    }

}
