<?php

namespace MarioDevv\Uptime\Tests\Monitor\Application\Find;

use MarioDevv\Uptime\Monitor\Application\CompleteMonitorDTO;
use MarioDevv\Uptime\Monitor\Application\Find\FindMonitor;
use MarioDevv\Uptime\Monitor\Application\Find\FindMonitorRequest;
use MarioDevv\Uptime\Monitor\Domain\Monitor;
use MarioDevv\Uptime\Tests\Monitor\MonitorUnitTestHelper;
use PHPUnit\Framework\TestCase;

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
        $expectedMonitor = Monitor::create(1, 'https://example.com', 30, 1);

        $this->find($expectedMonitor->id(), $expectedMonitor);

        $this->assemble($expectedMonitor, new CompleteMonitorDTO($expectedMonitor));

        $monitorDto = ($this->findMonitor)(new FindMonitorRequest(1));

        $this->assertEquals((new CompleteMonitorDTO($expectedMonitor))->json(), $monitorDto->json());
    }


}
