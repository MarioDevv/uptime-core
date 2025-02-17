<?php
declare(strict_types=1);

namespace MarioDevv\Uptime\Monitoring\Domain\Model\Monitor;
class MonitorState
{

    const int UP      = 1;
    const int DOWN    = 2;
    const int STOPPED = 3;
    const int PENDING = 4;


    private int $value;

    public function __construct(int $state)
    {
        if (!in_array($state, [self::UP, self::DOWN, self::STOPPED, self::PENDING])) {
            throw new \InvalidArgumentException('Invalid state');
        }

        $this->value = $state;
    }

    public function value(): int
    {
        return $this->value;
    }

    public static function fromHttpCode(int $statusCode): self
    {
        return ($statusCode >= 100 && $statusCode < 400)
            ? new MonitorState(self::UP)
            : new MonitorState(self::DOWN);
    }

    public function equals(MonitorState $other): bool
    {
        return $this->value === $other->value;
    }


}
