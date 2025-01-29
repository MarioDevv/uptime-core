<?php
declare(strict_types=1);

namespace Mario\Uptime\Monitor\Domain;

use DateTime;
use DateTimeImmutable;
use InvalidArgumentException;

class MonitorLastCheck
{

    private ?string $value;

    public function __construct(?string $date)
    {
        $this->ensureIsValidDate($date);

        $this->value = $date;
    }

    public static function now(): MonitorLastCheck
    {
        return new self(date('Y-m-d H:i:s'));
    }

    public function value(): ?string
    {
        return $this->value;
    }

    public function isOlderThan(MonitorInterval $interval): bool
    {
        if ($this->value === null) {
            return true;
        }

        $lastCheckTime = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $this->value);
        $nextCheckTime = $lastCheckTime->modify("+{$interval->value()} seconds");
        $currentTime   = new DateTimeImmutable();

        return $currentTime >= $nextCheckTime;
    }

    private function ensureIsValidDate(?string $date): void
    {
        if ($date === null) {
            return;
        }

        $date = DateTime::createFromFormat('Y-m-d H:i:s', $date);

        if ($date === false) {
            throw new InvalidArgumentException('Invalid date format');
        }
    }

}
