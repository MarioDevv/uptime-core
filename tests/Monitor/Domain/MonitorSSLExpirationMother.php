<?php

namespace MarioDevv\Uptime\Tests\Monitor\Domain;

use DateTimeImmutable;
use MarioDevv\Uptime\Monitoring\Domain\MonitorSSLExpiration;
use MarioDevv\Uptime\Tests\Utils\Domain\Date;

class MonitorSSLExpirationMother
{

    public static function random(?DateTimeImmutable $value = null): MonitorSSLExpiration
    {
        return new MonitorSSLExpiration($value ?? Date::random());
    }
}
