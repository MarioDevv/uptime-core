<?php

namespace MarioDevv\Uptime\Tests\Monitor\Domain;

use MarioDevv\Uptime\Monitor\Application\Create\CreateMonitorRequest;
use MarioDevv\Uptime\Monitor\Domain\Monitor;

class MonitorMother
{

    public static function random(
        ?int    $id = null,
        ?string $url = null,
        ?int    $interval = null,
        ?int    $state = null,
        ?int    $timeOut = null,
    ): Monitor
    {
        return new Monitor(
            $id ?? rand(1, 100),
            MonitorUrlMother::random($url),
            MonitorIntervalMother::random($interval),
            MonitorStateMother::random($state),
            MonitorTimeOutMother::random($timeOut),
            MonitorLastCheckMother::random(),
            MonitorSSLExpirationMother::random()
        );
    }


    public static function fromCreateRequest(CreateMonitorRequest $request): Monitor
    {
        return Monitor::create(
            rand(1, 100),
            $request->url(),
            $request->interval(),
            $request->timeOut()
        );
    }

}
