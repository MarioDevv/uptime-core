<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Application\ResumeMonitor;

use MarioDevv\Uptime\Monitoring\Application\ResumeMonitor\ResumeMonitor;
use MarioDevv\Uptime\Monitoring\Application\ResumeMonitor\ResumeMonitorRequest;
use MarioDevv\Uptime\Monitoring\Domain\Model\Monitor\MonitorState;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor\MonitorMother;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor\MonitorUnitTestHelper;

class ResumeMonitorTest extends MonitorUnitTestHelper
{

    private ResumeMonitor $resumeMonitor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->resumeMonitor = new ResumeMonitor(
            $this->repository()
        );
    }


    /** @test */
    public function it_should_resume_a_stopped_monitor()
    {

        $monitor = MonitorMother::random(state: MonitorState::STOPPED);

        $this->find($monitor->id(), $monitor);

        $expectedMonitor = MonitorMother::random(
            $monitor->id(),
            $monitor->url()->value(),
            $monitor->interval()->value(),
            MonitorState::PENDING,
            $monitor->timeOut()->value()
        );

        $this->save($expectedMonitor);

        ($this->resumeMonitor)(new ResumeMonitorRequest($monitor->id()));

    }

}
