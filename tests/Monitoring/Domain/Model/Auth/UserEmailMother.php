<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Auth;

use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\UserEmail;
use MarioDevv\Uptime\Tests\Utils\Domain\Email;

class UserEmailMother
{

    public static function random(?string $email = null): UserEmail
    {
        return new UserEmail($email ?? Email::random());
    }

}