<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Application\CreateMonitors;

use MarioDevv\Uptime\Monitoring\Application\CreateMonitor\CreateMonitor;
use MarioDevv\Uptime\Monitoring\Application\CreateMonitor\CreateMonitorRequest;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor\MonitorMother;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor\MonitorUnitTestHelper;

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
            rand(1, 10),
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
