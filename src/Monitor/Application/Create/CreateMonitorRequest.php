<?php

namespace MarioDevv\Uptime\Monitor\Application\Create;

class CreateMonitorRequest
{

    private string $url;
    private int $interval;
    private int $timeOut;

    public function __construct(
        string $url,
        int    $interval,
        int    $timeOut
    )
    {
        $this->url      = $url;
        $this->interval = $interval;
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

    public function timeOut(): int
    {
        return $this->timeOut;
    }

}
