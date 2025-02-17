<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Application\Stop;

use MarioDevv\Uptime\Monitoring\Application\Stop\StopMonitor;
use MarioDevv\Uptime\Monitoring\Application\Stop\StopMonitorRequest;
use MarioDevv\Uptime\Monitoring\Domain\Model\Monitor\MonitorNotFoundException;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor\MonitorMother;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor\MonitorUnitTestHelper;

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

        $expectedMonitor = MonitorMother::random();

        $this->find($expectedMonitor->id(), $expectedMonitor);

        $expectedMonitor->stop();

        $this->save($expectedMonitor);

        ($this->stopMonitor)(new StopMonitorRequest($expectedMonitor->id()));

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
