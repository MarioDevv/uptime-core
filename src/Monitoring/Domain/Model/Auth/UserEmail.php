<?php

namespace MarioDevv\Uptime\Monitoring\Domain\Model\Auth;

class UserEmail
{

    private string $value;

    /**
     * @throws InvalidUserEmailException
     */
    public function __construct(string $email)
    {
        $this->ensureIsValidEmail($email);
        $this->value = $email;
    }

    public function value(): string
    {
        return $this->value;
    }

    /**
     * @throws InvalidUserEmailException
     */
    private function ensureIsValidEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidUserEmailException($email);
        }
    }

}