<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor;

use MarioDevv\Uptime\Monitoring\Domain\Model\Monitor\MonitorHistory;
use MarioDevv\Uptime\Tests\Utils\Domain\Date;

class MonitorHistoryMother
{

    public static function random(
        ?int $httpCode = null,
    ): MonitorHistory
    {
        return new MonitorHistory(
            $httpCode ?? rand(100, 599),
            Date::random(),
            MonitorHistoryStateMother::random(),
            rand(0.1, 1.99)
        );
    }

}
