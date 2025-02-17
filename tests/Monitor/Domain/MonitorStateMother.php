<?php

namespace MarioDevv\Uptime\Tests\Monitor\Domain;

use MarioDevv\Uptime\Monitor\Domain\MonitorState;
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
                MonitorState::STOPPED
            ])
        );
    }
}
