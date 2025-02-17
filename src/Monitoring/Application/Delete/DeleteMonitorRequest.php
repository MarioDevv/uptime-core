<?php

namespace MarioDevv\Uptime\Monitoring\Application\Delete;

class DeleteMonitorRequest
{

    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }


    public function id(): int
    {
        return $this->id;
    }

}
