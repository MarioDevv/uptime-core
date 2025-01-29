<?php

namespace MarioDevv\Uptime\Monitor\Domain;

class MonitorTimeOut
{

    private int $value;

    public function __construct(int $timeOut)
    {

        if ($timeOut < 1 || $timeOut > 60) {
            throw new \InvalidArgumentException('Invalid timeout');
        }

        $this->value = $timeOut;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(MonitorTimeOut $other): bool
    {
        return $this->value === $other->value;
    }

}
