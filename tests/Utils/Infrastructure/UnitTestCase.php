<?php
declare(strict_types=1);

namespace MarioDevv\Uptime\Tests\Utils\Infrastructure;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;

abstract class UnitTestCase extends MockeryTestCase
{

    protected function mock(string $className): MockInterface
    {
        return Mockery::mock($className);
    }

}
