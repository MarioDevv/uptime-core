<?php

namespace MarioDevv\Uptime\Tests\Utils\Domain;

use Faker\Factory;

class Url
{
    public static function random(?string $value = null): string
    {
        return $value ?? Factory::create()->url();
    }
}

