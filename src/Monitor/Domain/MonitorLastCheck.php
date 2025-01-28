<?php
declare(strict_types=1);

namespace Mario\Uptime\Monitor\Domain;

use DateTime;
use InvalidArgumentException;

class MonitorLastCheck
{

    private ?string $value;

    public function __construct(?string $date)
    {
        $this->ensureIsValidDate($date);

        $this->value = $date;
    }

    public function value(): ?string
    {
        return $this->value;
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