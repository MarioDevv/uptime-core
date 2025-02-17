<?php

namespace MarioDevv\Uptime\Tests\Monitor\Domain;

use DateTimeImmutable;
use MarioDevv\Uptime\Monitor\Domain\MonitorLastCheck;
use MarioDevv\Uptime\Tests\Utils\Domain\Date;

class MonitorLastCheckMother
{

    public static function random(?DateTimeImmutable $value = null): MonitorLastCheck
    {
        return new MonitorLastCheck($value ?? Date::random());
    }
}
