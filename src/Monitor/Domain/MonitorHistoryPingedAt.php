<?php

namespace Mario\Uptime\Monitor\Domain;

use DateTime;

class MonitorHistoryPingedAt
{

    private string $value;

    public function __construct(string $pingedAt)
    {
        $this->ensureIsValidDate($pingedAt);

        $this->value = $pingedAt;
    }

    public function value(): string
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
            throw new \InvalidArgumentException('Invalid date format');
        }
    }

}
