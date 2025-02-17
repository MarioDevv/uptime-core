<?php

namespace MarioDevv\Uptime\Tests\Utils\Domain;

use Faker\Factory;
use InvalidArgumentException;

class Number
{
    public static function random(?int $value = null): int
    {
        return new $value ?? Factory::create()->randomNumber(3);
    }

    public static function between(int $min, int $max): int
    {
        return Factory::create()->numberBetween($min, $max);
    }

    public static function inArray(array $range): int
    {
        if (empty($range)) {
            throw new InvalidArgumentException("El array no puede estar vacío.");
        }

        $selected = $range[array_rand($range)];

        if (!is_int($selected)) {
            throw new InvalidArgumentException("El array debe contener solo enteros.");
        }

        return $selected;
    }
}

