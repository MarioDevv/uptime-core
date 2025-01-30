<?php

namespace MarioDevv\Uptime\Monitor\Application;

use MarioDevv\Uptime\Monitor\Domain\Monitor;

class CompleteMonitorDTO
{

    private int $id;
    private string $url;
    private int $status;
    private int $interval;
    private ?string $lastCheck;
    private float $responseTimeAvg;
    private float $responseTimeMax;
    private float $responseTimeMin;
    private array $history;

    public function __construct(Monitor $monitor, ...$args)
    {
        $this->id              = $monitor->id();
        $this->url             = $monitor->url()->value();
        $this->status          = $monitor->state()->value();
        $this->interval        = $monitor->interval()->value();
        $this->lastCheck       = $monitor->lastCheck()->format();
        $this->responseTimeAvg = $monitor->responseTimeAvg();
        $this->responseTimeMax = $monitor->responseTimeMax();
        $this->responseTimeMin = $monitor->responseTimeMin();
        $this->history         = $monitor->history();

    }


    public function json(): array
    {
        return [
            'id'              => $this->id,
            'url'             => $this->url,
            'status'          => $this->status,
            'interval'        => $this->interval,
            'lastCheck'       => $this->lastCheck,
            'responseTimeAvg' => $this->responseTimeAvg,
            'responseTimeMax' => $this->responseTimeMax,
            'responseTimeMin' => $this->responseTimeMin,
            'history'         => $this->history,
        ];
    }
}