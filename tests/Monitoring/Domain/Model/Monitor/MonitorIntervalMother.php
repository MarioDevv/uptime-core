<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor;

use MarioDevv\Uptime\Monitoring\Domain\Model\Monitor\MonitorInterval;
use MarioDevv\Uptime\Tests\Utils\Domain\Number;

class MonitorIntervalMother
{

    public static function random(?int $value = null): MonitorInterval
    {
        return new MonitorInterval(
            $value
            ??
            Number::inArray([
                MonitorInterval::INTERVAL_1_MIN,
                MonitorInterval::INTERVAL_30_SEC,
                MonitorInterval::INTERVAL_5_MIN,
            ])
        );
    }
}
