<?php

namespace MarioDevv\Uptime\Tests\Monitor\Application\Delete;

use MarioDevv\Uptime\Monitor\Application\Delete\DeleteMonitor;
use MarioDevv\Uptime\Monitor\Application\Delete\DeleteMonitorRequest;
use MarioDevv\Uptime\Monitor\Domain\Monitor;
use MarioDevv\Uptime\Tests\Monitor\MonitorUnitTestHelper;

class DeleteMonitorTest extends MonitorUnitTestHelper
{

    private DeleteMonitor $deleteMonitor;

    protected function setUp(): void
    {
        parent::__construct();
        $this->deleteMonitor = new DeleteMonitor($this->repository());
    }

    /** @test */
    public function it_should_delete_a_monitor()
    {

        $this->nextIdentity(1);

        $monitor = Monitor::create(1, 'https://www.google.com', 60, 1);

        $this->find(1, $monitor);

        $this->delete($monitor);

        ($this->deleteMonitor)(new DeleteMonitorRequest(1));


    }
}
