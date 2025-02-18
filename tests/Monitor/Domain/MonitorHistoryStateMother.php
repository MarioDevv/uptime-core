<?php

namespace MarioDevv\Uptime\Tests\Monitor\Domain;

use MarioDevv\Uptime\Monitoring\Domain\MonitorHistoryState;
use MarioDevv\Uptime\Tests\Utils\Domain\Number;

class MonitorHistoryStateMother
{
    public static function random(?int $value = null): MonitorHistoryState
    {
        return new MonitorHistoryState(
            $value
            ??
            Number::inArray([
                MonitorHistoryState::UP,
                MonitorHistoryState::DOWN
            ])
        );
    }
}
