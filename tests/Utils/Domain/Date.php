<?php

namespace MarioDevv\Uptime\Tests\Utils\Domain;

use Faker\Factory;
use DateTimeImmutable;

class Date
{
    public static function random(?string $value = null): DateTimeImmutable
    {
        return new DateTimeImmutable($value ?? Factory::create()->date());
    }
}

