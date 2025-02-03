<?php

namespace MarioDevv\Uptime\Tests\Monitor\Application\Ping;

use MarioDevv\Uptime\Monitor\Application\Ping\PingMonitor;
use MarioDevv\Uptime\Monitor\Application\Ping\PingMonitorRequest;
use MarioDevv\Uptime\Monitor\Domain\Monitor;
use MarioDevv\Uptime\Tests\Monitor\Domain\PingTestService;
use MarioDevv\Uptime\Tests\Monitor\MonitorUnitTestHelper;

class PingTest extends MonitorUnitTestHelper
{

    private PingMonitor $ping;
    private PingTestService $pingService;

    protected function setUp(): void
    {
        parent::__construct();

        $this->pingService = new PingTestService(1, 0.1);

        $this->ping = new PingMonitor(
            $this->repository(),
            $this->pingService
        );
    }

    /** @test */
    public function it_should_ping_a_monitor(): void
    {

        $this->nextIdentity(1);

        $monitor = Monitor::create(1, 'https://www.google.com', 60, 1);

        $this->find(1, $monitor);

        $monitor->ping($this->pingService);

        $this->save($monitor);

        $this->assertEquals(1, $monitor->state()->value());
        $this->assertCount(1, $monitor->history());

        ($this->ping)(new PingMonitorRequest(1));
    }
}
