<?php
declare(strict_types=1);

namespace MarioDevv\Uptime\Monitor\Domain;
class MonitorState
{

    const int UP      = 1;
    const int DOWN    = 2;
    const int STOPPED = 3;


    private int $value;

    public function __construct(int $state)
    {
        if (!in_array($state, [self::UP, self::DOWN, self::STOPPED])) {
            throw new \InvalidArgumentException('Invalid state');
        }

        $this->value = $state;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(MonitorState $other): bool
    {
        return $this->value === $other->value;
    }


}
