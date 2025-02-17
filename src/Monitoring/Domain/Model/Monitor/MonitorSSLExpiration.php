<?php

namespace MarioDevv\Uptime\Monitoring\Domain\Model\Monitor;

use DateTimeImmutable;

class MonitorSSLExpiration
{

    private ?DateTimeImmutable $value;

    public function __construct(?DateTimeImmutable $date)
    {
        $this->value = $date;
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
}
