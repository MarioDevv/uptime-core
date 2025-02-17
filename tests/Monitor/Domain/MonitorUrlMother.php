<?php

namespace MarioDevv\Uptime\Tests\Monitor\Domain;

use MarioDevv\Uptime\Monitoring\Domain\MonitorUrl;
use MarioDevv\Uptime\Tests\Utils\Domain\Url;

class MonitorUrlMother
{

    public static function random(?string $value = null): MonitorUrl
    {
        return new MonitorUrl($value ?? Url::random());
    }
}
