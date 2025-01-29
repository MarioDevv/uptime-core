<?php

namespace MarioDevv\Uptime\Monitor\Domain;

use DateTime;
use DateTimeImmutable;

class MonitorHistoryPingedAt
{

    private DateTimeImmutable $value;

    public function __construct(DateTimeImmutable $pingedAt)
    {
        $this->value = $pingedAt;
    }

    public function value(): DateTimeImmutable
    {
        return $this->value;
    }

}
