<?php

namespace MarioDevv\Uptime\Tests\Monitor\Application\Create;

use MarioDevv\Uptime\Monitoring\Application\Create\CreateMonitor;
use MarioDevv\Uptime\Monitoring\Application\Create\CreateMonitorRequest;
use MarioDevv\Uptime\Tests\Monitor\Domain\MonitorMother;
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

        $request = new CreateMonitorRequest(
            'https://www.google.com',
            60,
            1,
        );

        $expectedMonitor = MonitorMother::fromCreateRequest($request);

        $this->nextIdentity($expectedMonitor->id());

        $this->save($expectedMonitor);

        ($this->createMonitor)($request);

    }


}
