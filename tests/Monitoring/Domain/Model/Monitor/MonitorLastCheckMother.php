<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor;

use DateTimeImmutable;
use MarioDevv\Uptime\Monitoring\Domain\Model\Monitor\MonitorLastCheck;
use MarioDevv\Uptime\Tests\Utils\Domain\Date;

class MonitorLastCheckMother
{

    public static function random(?DateTimeImmutable $value = null): MonitorLastCheck
    {
        return new MonitorLastCheck($value ?? Date::random());
    }
}
