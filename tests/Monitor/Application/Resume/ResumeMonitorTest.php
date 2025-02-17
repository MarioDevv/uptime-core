<?php

namespace MarioDevv\Uptime\Tests\Monitor\Application\Resume;

use MarioDevv\Uptime\Monitoring\Application\Resume\ResumeMonitor;
use MarioDevv\Uptime\Monitoring\Application\Resume\ResumeMonitorRequest;
use MarioDevv\Uptime\Monitoring\Domain\MonitorState;
use MarioDevv\Uptime\Tests\Monitor\Domain\MonitorMother;
use MarioDevv\Uptime\Tests\Monitor\MonitorUnitTestHelper;

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
