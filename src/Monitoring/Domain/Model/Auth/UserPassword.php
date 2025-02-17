<?php

namespace MarioDevv\Uptime\Monitoring\Domain\Model\Auth;

class UserPassword
{

    private string $value;

    /**
     * @throws InvalidUserPasswordException
     */
    public function __construct(string $password)
    {
        $this->ensureIsASecurePassword($password);
        $this->value = $password;
    }

    public function value(): string
    {
        return $this->value;
    }

    /**
     * @throws InvalidUserPasswordException
     */
    private function ensureIsASecurePassword(string $password): void
    {
        if (!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*\d)\S*$/", $password)) {
            throw new InvalidUserPasswordException();
        }
    }

}