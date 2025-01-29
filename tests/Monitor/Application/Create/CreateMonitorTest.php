<?php

namespace MarioDevv\Uptime\Tests\Monitor\Application\Create;

use MarioDevv\Uptime\Monitor\Application\Create\CreateMonitor;
use MarioDevv\Uptime\Monitor\Application\Create\CreateMonitorRequest;
use MarioDevv\Uptime\Monitor\Domain\Monitor;
use MarioDevv\Uptime\Tests\Monitor\MonitorUnitTestHelper;

class CreateMonitorTest extends MonitorUnitTestHelper
{

    private CreateMonitor $createMonitor;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createMonitor = new CreateMonitor($this->repository());
    }


    /** @test */
    public function it_should_create_a_monitor(): void
    {

        $expectedMonitor = Monitor::create(
            1,
            'https://www.google.com',
            60,
            1,
        );

        $this->nextIdentity(1);

        $this->save($expectedMonitor);

        ($this->createMonitor)
        (new CreateMonitorRequest(
            'https://www.google.com',
            60,
            1,
        ));

    }


}
