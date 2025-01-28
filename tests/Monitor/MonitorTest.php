<?php

namespace Mario\Uptime\Tests\Monitor\Domain;

use Mario\Uptime\Monitor\Domain\Monitor;
use Mario\Uptime\Monitor\Domain\MonitorInterval;
use Mario\Uptime\Monitor\Domain\MonitorState;
use Mario\Uptime\Monitor\Domain\MonitorTimeOut;
use Mario\Uptime\Monitor\Domain\MonitorUrl;
use PHPUnit\Framework\TestCase;

class MonitorTest extends TestCase
{

    /** @test */
    public function it_should_create_a_monitor(): void
    {
        $monitor = new Monitor(
            1,
            new MonitorUrl('https://www.google.com'),
            new MonitorInterval(60),
            new MonitorState(MonitorState::UP),
            new MonitorTimeOut(10)
        );

        $this->assertEquals(1, $monitor->id());
        $this->assertEquals('https://www.google.com', $monitor->url()->value());
        $this->assertEquals(60, $monitor->interval()->value());
        $this->assertEquals(MonitorState::UP, $monitor->state()->value());
        $this->assertEquals(10, $monitor->timeOut()->value());
    }

    /** @test */
    public function it_should_ping_a_monitor(): void
    {
        $monitor = new Monitor(
            1,
            new MonitorUrl('https://www.google.com'),
            new MonitorInterval(60),
            new MonitorState(MonitorState::UP),
            new MonitorTimeOut(10)
        );

        $monitor->ping();

        $this->assertEquals(MonitorState::UP, $monitor->state()->value());
    }

    /** @test */
    public function it_should_throw_an_error_if_url_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Monitor(
            1,
            new MonitorUrl('invalid url'),
            new MonitorInterval(60),
            new MonitorState(MonitorState::UP),
            new MonitorTimeOut(10)
        );
    }

    /** @test */
    public function it_should_throw_an_error_if_interval_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Monitor(
            1,
            new MonitorUrl('https://www.google.com'),
            new MonitorInterval(0),
            new MonitorState(MonitorState::UP),
            new MonitorTimeOut(10)
        );
    }

    /** @test */
    public function it_should_throw_an_error_if_timeout_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Monitor(
            1,
            new MonitorUrl('https://www.google.com'),
            new MonitorInterval(60),
            new MonitorState(MonitorState::UP),
            new MonitorTimeOut(0)
        );
    }

    /** @test */
    public function it_should_change_state_if_site_is_down()
    {

        $monitor = new Monitor(
            1,
            new MonitorUrl('https://www.google.com/404'),
            new MonitorInterval(60),
            new MonitorState(MonitorState::UP),
            new MonitorTimeOut(10)
        );

        $monitor->ping();

        $this->assertEquals(MonitorState::DOWN, $monitor->state()->value());
    }

}
