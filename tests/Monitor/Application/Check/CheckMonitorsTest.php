<?php

namespace MarioDevv\Uptime\Tests\Monitor\Application\Check;

use MarioDevv\Uptime\Monitor\Application\Check\CheckMonitors;
use MarioDevv\Uptime\Monitor\Domain\Monitor;
use MarioDevv\Uptime\Tests\Monitor\Domain\PingTestService;
use MarioDevv\Uptime\Tests\Monitor\MonitorUnitTestHelper;

class CheckMonitorsTest extends MonitorUnitTestHelper
{

    private CheckMonitors   $checkMonitors;
    private PingTestService $pingTestService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pingTestService = new PingTestService(1, 0.1);

        $this->checkMonitors = new CheckMonitors(
            $this->repository(),
            $this->pingTestService
        );
    }

    /** @test */
    public function it_should_check_all_monitors()
    {


        $monitors = $this->randomMonitors();

        $this->all($monitors);

        foreach ($monitors as $monitor) {

            $monitor->ping($this->pingTestService);

            $this->assertCount(1, $monitor->history());

            $this->save($monitor);

        }

        ($this->checkMonitors)();

    }

    private function randomMonitors(): array
    {

        $array = [];

        for ($i = 0; $i < 10; $i++) {

            $monitor = Monitor::create($i + 1, 'https://www.google.com', 60, 1);

            $array[] = $monitor;

        }

        return $array;

    }


}
