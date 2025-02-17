<?php

namespace MarioDevv\Uptime\Tests\Utils\Domain;


class Password
{
    public static function random(?string $value = null): string
    {
        return $value ?? self::generateSecurePassword();
    }

    private static function generateSecurePassword(): string
    {
        $uppercase = chr(rand(65, 90));
        $lowercase = chr(rand(97, 122));
        $digit = chr(rand(48, 57));
        $remainingLength = 5;

        $remaining = bin2hex(random_bytes($remainingLength));

        return str_shuffle(
            $uppercase . $lowercase . $digit . substr($remaining, 0, 5)
        );
    }
}
