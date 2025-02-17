<?php

namespace MarioDevv\Uptime\Monitoring\Application\FindUser;

class FindUserResponse
{

    private int $id;
    private string $email;
    private string $name;

    public function __construct(int $id, string $email, string $name)
    {
        $this->id    = $id;
        $this->email = $email;
        $this->name  = $name;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function name(): string
    {
        return $this->name;
    }


    public function json(): array
    {
        return [
            'id'    => $this->id,
            'email' => $this->email,
            'name'  => $this->name
        ];
    }

}