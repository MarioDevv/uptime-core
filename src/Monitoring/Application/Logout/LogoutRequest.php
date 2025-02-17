<?php

namespace MarioDevv\Uptime\Monitoring\Application\Logout;

class LogoutRequest
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