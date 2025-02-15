<?php

namespace MarioDevv\Uptime\Tests\Monitor\Application\Stop;

use MarioDevv\Uptime\Monitor\Application\Stop\StopMonitor;
use MarioDevv\Uptime\Monitor\Application\Stop\StopMonitorRequest;
use MarioDevv\Uptime\Monitor\Domain\Monitor;
use MarioDevv\Uptime\Monitor\Domain\MonitorNotFoundException;
use MarioDevv\Uptime\Tests\Monitor\MonitorUnitTestHelper;

class StopMonitorTest extends MonitorUnitTestHelper
{

    private StopMonitor $stopMonitor;

    protected function setUp(): void
    {
        parent::setUp();
        $this->stopMonitor = new StopMonitor(
            $this->repository()
        );
    }

    /** @test */
    public function it_should_stop_a_monitor()
    {

        $expectedMonitor = Monitor::create(1, 'https://example.com', 30, 1);

        $this->find($expectedMonitor->id(), $expectedMonitor);

        $expectedMonitor->stop();

        $this->save($expectedMonitor);

        ($this->stopMonitor)(new StopMonitorRequest(1));

    }


    /** @test */
    public function it_should_throw_an_error_when_monitor_not_found()
    {

        $expectedMonitor = null;

        $this->find(1, $expectedMonitor);

        $this->expectException(MonitorNotFoundException::class);

        ($this->stopMonitor)(new StopMonitorRequest(1));

    }

}