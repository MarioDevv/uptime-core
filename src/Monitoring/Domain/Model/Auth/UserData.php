<?php

namespace MarioDevv\Uptime\Monitoring\Domain\Model\Auth;

class UserData
{
    private int $id;
    private string $name;
    private string $email;

    public function __construct(
        int    $id,
        string $name,
        string $email,
    )
    {
        $this->id    = $id;
        $this->name  = $name;
        $this->email = $email;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

}