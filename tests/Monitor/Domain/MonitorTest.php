<?php

namespace MarioDevv\Uptime\Tests\Monitor\Domain;

use MarioDevv\Uptime\Monitor\Domain\Monitor;
use MarioDevv\Uptime\Monitor\Domain\MonitorHistory;
use MarioDevv\Uptime\Monitor\Domain\MonitorState;

use PHPUnit\Framework\TestCase;

class MonitorTest extends TestCase
{

    /** @test */
    public function it_should_create_a_monitor(): void
    {
        $monitor = Monitor::create(
            1,
            'https://www.google.com',
            60,
            10
        );

        $this->assertEquals(1, $monitor->id());
        $this->assertEquals('https://www.google.com', $monitor->url()->value());
        $this->assertEquals(60, $monitor->interval()->value());
        $this->assertEquals(MonitorState::UP, $monitor->state()->value());
        $this->assertEquals(10, $monitor->timeOut()->value());
    }

    /** @test */
    public function it_should_throw_an_error_if_url_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);

        Monitor::create(
            1,
            'invalid-url',
            60,
            10
        );
    }

    /** @test */
    public function it_should_throw_an_error_if_interval_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);

        Monitor::create(
            1,
            'https://www.google.com',
            0,
            10
        );
    }

    /** @test */
    public function it_should_throw_an_error_if_timeout_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);

        Monitor::create(
            1,
            'https://www.google.com',
            60,
            0
        );
    }

    /** @test */
    public function it_should_add_history_of_the_ping()
    {

        $monitor = Monitor::create(
            1,
            'https://www.google.com',
            300,
            10
        );

        $monitor->ping(new PingTestService(1, 0.3));

        $this->assertCount(1, $monitor->history());

    }

}
