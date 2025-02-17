<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor;

use DateTimeImmutable;
use MarioDevv\Uptime\Monitoring\Domain\Model\Monitor\MonitorSSLExpiration;
use MarioDevv\Uptime\Tests\Utils\Domain\Date;

class MonitorSSLExpirationMother
{

    public static function random(?DateTimeImmutable $value = null): MonitorSSLExpiration
    {
        return new MonitorSSLExpiration($value ?? Date::random());
    }
}
