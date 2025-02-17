<?php

namespace MarioDevv\Uptime\Monitoring\Application\FindUser;

class FindUserRequest
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