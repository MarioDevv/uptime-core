<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Auth;

use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\UserPassword;
use MarioDevv\Uptime\Tests\Utils\Domain\Password;

class UserPasswordMother
{

    public static function random(?string $value = null): UserPassword
    {
        return new UserPassword($value ?? Password::random());
    }
}