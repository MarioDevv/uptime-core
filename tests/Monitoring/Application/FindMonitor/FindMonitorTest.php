<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Application\FindMonitor;

use MarioDevv\Uptime\Monitoring\Application\FindMonitor\FindMonitor;
use MarioDevv\Uptime\Monitoring\Application\FindMonitor\FindMonitorRequest;
use MarioDevv\Uptime\Monitoring\Domain\Model\Monitor\MonitorNotFoundException;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor\MonitorMother;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor\MonitorUnitTestHelper;

class FindMonitorTest extends MonitorUnitTestHelper
{

    private FindMonitor $findMonitor;

    protected function setUp(): void
    {
        parent::setUp();
        $this->findMonitor = new FindMonitor($this->repository(), $this->assembler());
    }

    /** @test */
    public function it_should_find_a_monitor()
    {
        $expectedMonitor = MonitorMother::random();

        $this->find($expectedMonitor->id(), $expectedMonitor);

        $this->assemble($expectedMonitor);

        ($this->findMonitor)(new FindMonitorRequest($expectedMonitor->id()));

    }

    /** @test */
    public function it_should_throw_an_error_when_monitor_not_found(): void
    {
        $expectedMonitor = null;

        $this->find(1, $expectedMonitor);

        $this->expectException(MonitorNotFoundException::class);

        ($this->findMonitor)(new FindMonitorRequest(1));
    }


}
