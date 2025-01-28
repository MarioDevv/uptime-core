<?php

namespace Mario\Uptime\Monitor\Domain;

class MonitorInterval
{

    const int INTERVAL_30_SEC = 30;
    const int INTERVAL_1_MIN  = 60;
    const int INTERVAL_5_MIN  = 300;

    private int $value;

    public function __construct(int $interval)
    {
        if (!in_array($interval, [self::INTERVAL_30_SEC, self::INTERVAL_1_MIN, self::INTERVAL_5_MIN])) {
            throw new \InvalidArgumentException('Invalid interval');
        }

        $this->value = $interval;
    }


    public function value(): int
    {
        return $this->value;
    }

}