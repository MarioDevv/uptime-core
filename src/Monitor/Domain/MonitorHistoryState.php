<?php

namespace MarioDevv\Uptime\Monitor\Domain;

class MonitorHistoryState
{

    const int UP = 1;
    const int DOWN = 2;

    private int $value;

    public function __construct(int $state)
    {
        if (!in_array($state, [self::UP, self::DOWN])) {
            throw new \InvalidArgumentException('Invalid state');
        }

        $this->value = $state;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(MonitorHistoryState $other): bool
    {
        return $this->value === $other->value;
    }

}
