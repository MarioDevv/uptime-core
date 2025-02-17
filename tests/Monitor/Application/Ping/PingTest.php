<?php

namespace MarioDevv\Uptime\Tests\Monitor\Application\Ping;

use MarioDevv\Uptime\Monitor\Application\Ping\PingMonitor;
use MarioDevv\Uptime\Monitor\Application\Ping\PingMonitorRequest;
use MarioDevv\Uptime\Monitor\Domain\MonitorNotFoundException;
use MarioDevv\Uptime\Monitor\Domain\MonitorState;
use MarioDevv\Uptime\Tests\Monitor\Domain\MonitorHistoryMother;
use MarioDevv\Uptime\Tests\Monitor\Domain\MonitorMother;
use MarioDevv\Uptime\Tests\Monitor\Domain\MonitorPingInformationMother;
use MarioDevv\Uptime\Tests\Monitor\MonitorUnitTestHelper;

class PingTest extends MonitorUnitTestHelper
{

    private PingMonitor $ping;

    protected function setUp(): void
    {
        parent::__construct();

        $this->ping = new PingMonitor(
            $this->repository(),
            $this->pingService(),
            $this->notifier()
        );
    }

    /** @test */
    public function it_should_ping_a_monitor(): void
    {

        $monitor = MonitorMother::random(state: MonitorState::UP);

        $this->find($monitor->id(), $monitor);


        $this->ping(
            $monitor->url(),
            $monitor->timeOut(),
            MonitorPingInformationMother::random()
        );

        $this->save($monitor);

        ($this->ping)(new PingMonitorRequest($monitor->id()));

    }


    /** @test */
    public function it_should_throw_an_error_when_monitor_not_found(): void
    {

        $monitor = null;

        $this->find(1, $monitor);

        $this->expectException(MonitorNotFoundException::class);

        ($this->ping)(new PingMonitorRequest(1));
    }

    /** @test */
    public function it_should_notify_if_monitor_has_two_consecutive_fails(): void
    {

        $monitor = MonitorMother::random(state: MonitorState::DOWN);

        $firstFail = MonitorHistoryMother::random(httpCode: 400);
        $monitor->addHistory($firstFail);


        $this->find($monitor->id(), $monitor);

        $this->ping(
            $monitor->url(),
            $monitor->timeOut(),
            MonitorPingInformationMother::random(httpCode: 400)
        );

        $this->wasNotified($monitor);

        $this->save($monitor);

        ($this->ping)(new PingMonitorRequest($monitor->id()));
    }


    /** @test */
    public function it_should_not_notify_if_failures_are_not_consecutive(): void
    {
        $monitor = MonitorMother::random(state: MonitorState::DOWN);

        $firstFail = MonitorHistoryMother::random(httpCode: 404);
        $monitor->addHistory($firstFail);

        $secondSuccess = MonitorHistoryMother::random(httpCode: 200);
        $monitor->addHistory($secondSuccess);

        $this->find($monitor->id(), $monitor);

        $this->ping(
            $monitor->url(),
            $monitor->timeOut(),
            MonitorPingInformationMother::random(httpCode: 404)
        );

        $this->notifier()->shouldNotReceive('notify');

        $this->save($monitor);

        ($this->ping)(new PingMonitorRequest($monitor->id()));
    }


}
