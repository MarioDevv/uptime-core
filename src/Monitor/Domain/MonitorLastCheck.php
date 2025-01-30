<?php
declare(strict_types=1);

namespace MarioDevv\Uptime\Monitor\Domain;

use DateTime;
use DateTimeImmutable;
use InvalidArgumentException;

class MonitorLastCheck
{

    private ?DateTimeImmutable $value;

    public function __construct(?DateTimeImmutable $date)
    {
        $this->value = $date;
    }

    public static function now(): MonitorLastCheck
    {
        return new self(new DateTimeImmutable());
    }

    public function value(): ?DateTimeImmutable
    {
        return $this->value;
    }

    public function format(string $format = 'Y-m-d H:i:s'): string
    {
        if ($this->value === null) {
            return '';
        }

        return $this->value->format($format);
    }

    public function isOlderThan(MonitorInterval $interval): bool
    {
        if ($this->value === null) {
            return true;
        }

        $nextCheckTime = $this->value->modify("+{$interval->value()} seconds");
        $currentTime = new DateTimeImmutable();

        return $currentTime >= $nextCheckTime;
    }

}
