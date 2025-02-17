<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Auth;

use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\UserData;
use MarioDevv\Uptime\Tests\Utils\Domain\Email;
use MarioDevv\Uptime\Tests\Utils\Domain\Name;

class UserDataMother
{

    public static function random(
        ?int    $id = null,
        ?string $email = null,
        ?string $name = null
    ): UserData
    {
        return new UserData(
            $id ?? rand(1, 10),
            $email ?? Email::random(),
            $name ?? Name::random()
        );
    }

}