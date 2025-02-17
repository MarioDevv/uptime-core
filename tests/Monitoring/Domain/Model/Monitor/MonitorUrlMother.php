<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor;

use MarioDevv\Uptime\Monitoring\Domain\Model\Monitor\MonitorUrl;
use MarioDevv\Uptime\Tests\Utils\Domain\Url;

class MonitorUrlMother
{

    public static function random(?string $value = null): MonitorUrl
    {
        return new MonitorUrl($value ?? Url::random());
    }
}
