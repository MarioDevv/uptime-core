<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor;

use MarioDevv\Uptime\Monitoring\Domain\Model\Monitor\MonitorState;
use MarioDevv\Uptime\Tests\Utils\Domain\Number;

class MonitorStateMother
{


    public static function random(?int $value = null): MonitorState
    {
        return new MonitorState(
            $value
            ??
            Number::inArray([
                MonitorState::UP,
                MonitorState::DOWN,
                MonitorState::STOPPED,
                MonitorState::PENDING
            ])
        );
    }
}
