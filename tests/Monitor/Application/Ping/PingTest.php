<?php

namespace MarioDevv\Uptime\Tests\Monitor\Application\Ping;

use MarioDevv\Uptime\Monitor\Application\Ping\PingMonitor;
use MarioDevv\Uptime\Monitor\Application\Ping\PingMonitorRequest;
use MarioDevv\Uptime\Monitor\Domain\Monitor;
use MarioDevv\Uptime\Monitor\Domain\MonitorNotFoundException;
use MarioDevv\Uptime\Tests\Monitor\Domain\PingTestService;
use MarioDevv\Uptime\Tests\Monitor\MonitorUnitTestHelper;

class PingTest extends MonitorUnitTestHelper
{

    private PingMonitor $ping;
    private PingTestService $pingService;

    protected function setUp(): void
    {
        parent::__construct();

        $this->pingService = new PingTestService(300, 0.1);

        $this->ping = new PingMonitor(
            $this->repository(),
            $this->pingService
        );
    }

    /** @test */
    public function it_should_ping_a_monitor(): void
    {

        $monitor = Monitor::create(1, 'https://www.google.com', 60, 1);

        $this->find(1, $monitor);

        $monitor->ping($this->pingService);

        $this->save($monitor);

        $this->assertEquals(1, $monitor->state()->value());
        $this->assertCount(1, $monitor->history());

        ($this->ping)(new PingMonitorRequest(1));
    }


    /** @test */
    public function it_should_throw_an_error_when_monitor_not_found(): void
    {

        $monitor = null;

        $this->find(1, $monitor);

        $this->expectException(MonitorNotFoundException::class);

        ($this->ping)(new PingMonitorRequest(1));
    }

}
