<?php

namespace MarioDevv\Uptime\Monitoring\Application\CreateMonitor;

class CreateMonitorRequest
{

    private int    $userID;
    private string $url;
    private int    $interval;
    private int    $timeOut;

    public function __construct(
        int    $userID,
        string $url,
        int    $interval,
        int    $timeOut
    )
    {
        $this->userID   = $userID;
        $this->url      = $url;
        $this->interval = $interval;
        $this->timeOut  = $timeOut;
    }

    public function userID(): int
    {
        return $this->userID;
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
