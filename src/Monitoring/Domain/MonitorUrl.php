<?php

namespace MarioDevv\Uptime\Monitoring\Domain;

class MonitorUrl
{

    private string $value;

    public function __construct(string $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Invalid URL');
        }

        $this->value = $url;
    }


    public function value(): string
    {
        return $this->value;
    }

    public function equals(MonitorUrl $other): bool
    {
        return $this->value === $other->value;
    }


}
