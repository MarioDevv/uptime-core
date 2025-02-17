<?php

namespace MarioDevv\Uptime\Tests\Monitor\Domain;

use MarioDevv\Uptime\Monitoring\Domain\Monitor;

use PHPUnit\Framework\TestCase;

class MonitorTest extends TestCase
{

    /** @test */
    public function it_should_create_a_monitor(): void
    {
        $monitor = MonitorMother::random();

        $this->assertInstanceOf(Monitor::class, $monitor);
    }

    /** @test */
    public function it_should_throw_an_error_if_url_is_invalid()
    {

        $this->expectException(\InvalidArgumentException::class);

        MonitorMother::random(url: 'invalid-url');
    }

    /** @test */
    public function it_should_throw_an_error_if_interval_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);

        MonitorMother::random(state: 101);
    }

    /** @test */
    public function it_should_throw_an_error_if_timeout_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);

        MonitorMother::random(timeOut: 101);

    }

    /** @test */
    public function it_should_add_history_of_the_ping()
    {

        $monitor = MonitorMother::random();

        $history = MonitorHistoryMother::random();

        $monitor->addHistory($history);

        $this->assertCount(1, $monitor->history());


    }

}
