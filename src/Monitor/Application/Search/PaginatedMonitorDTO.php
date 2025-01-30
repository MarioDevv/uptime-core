<?php

namespace MarioDevv\Uptime\Monitor\Application\Search;

use MarioDevv\Uptime\Monitor\Domain\Monitor;

class PaginatedMonitorDTO
{

    private int     $id;
    private string  $url;
    private int     $status;
    private ?string $lastCheck;

    public function __construct(Monitor $monitor, ...$args)
    {
        $this->id        = $monitor->id();
        $this->url       = $monitor->url()->value();
        $this->status    = $monitor->state()->value();
        $this->lastCheck = $monitor->lastCheck()->format();
    }


    public function json(): array
    {
        return [
            'id'        => $this->id,
            'url'       => $this->url,
            'status'    => $this->status,
            'lastCheck' => $this->lastCheck,
        ];

    }

}
