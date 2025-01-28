<?php

namespace Mario\Uptime\Monitor\Application\Create;

class CreateMonitorRequest
{

    private string $url;
    private int $interval;
    private int $state;
    private int $timeOut;

    public function __construct(
        string $url,
        int    $interval,
        int    $state,
        int    $timeOut
    )
    {
        $this->url      = $url;
        $this->interval = $interval;
        $this->state    = $state;
        $this->timeOut  = $timeOut;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function interval(): int
    {
        return $this->interval;
    }

    public function state(): int
    {
        return $this->state;
    }

    public function timeOut(): int
    {
        return $this->timeOut;
    }

}