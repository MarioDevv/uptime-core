<?php

namespace MarioDevv\Uptime\Tests\Monitor\Domain;

use MarioDevv\Uptime\Monitoring\Domain\MonitorPingInformation;
use MarioDevv\Uptime\Tests\Utils\Domain\Date;

class MonitorPingInformationMother
{

    public static function random(
        ?int $httpCode = null,
    ): MonitorPingInformation
    {
        return new MonitorPingInformation(
            $httpCode ?? rand(100, 599),
            rand(0.1, 3.99),
            Date::random()
        );
    }
}
