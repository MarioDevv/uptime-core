<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor;

use MarioDevv\Uptime\Monitoring\Domain\Model\Monitor\MonitorTimeOut;
use MarioDevv\Uptime\Tests\Utils\Domain\Number;

class MonitorTimeOutMother
{

    public static function random(?int $value = null): MonitorTimeOut
    {
        return new MonitorTimeOut($value ?? Number::between(1, 60));
    }

}
