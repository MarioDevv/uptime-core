<?php

namespace MarioDevv\Uptime\Tests\Monitor\Application\Delete;

use MarioDevv\Uptime\Monitoring\Application\Delete\DeleteMonitor;
use MarioDevv\Uptime\Monitoring\Application\Delete\DeleteMonitorRequest;
use MarioDevv\Uptime\Monitoring\Domain\MonitorNotFoundException;
use MarioDevv\Uptime\Tests\Monitor\Domain\MonitorMother;
use MarioDevv\Uptime\Tests\Monitor\MonitorUnitTestHelper;

class DeleteMonitorTest extends MonitorUnitTestHelper
{

    private DeleteMonitor $deleteMonitor;

    protected function setUp(): void
    {
        parent::setUp();
        $this->deleteMonitor = new DeleteMonitor($this->repository());
    }

    /** @test */
    public function it_should_delete_a_monitor()
    {

        $monitor = MonitorMother::random();

        $this->find($monitor->id(), $monitor);

        $this->delete($monitor);

        ($this->deleteMonitor)(new DeleteMonitorRequest($monitor->id()));

    }

    /** @test */
    public function it_should_throw_an_error_when_monitor_not_found()
    {

        $monitor = null;

        $this->find(1, $monitor);

        $this->expectException(MonitorNotFoundException::class);

        ($this->deleteMonitor)(new DeleteMonitorRequest(1));

    }
}
