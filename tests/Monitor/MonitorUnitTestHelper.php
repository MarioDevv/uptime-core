<?php

namespace Mario\Uptime\Tests\Monitor;

use Mario\Uptime\Monitor\Domain\Monitor;
use Mario\Uptime\Monitor\Domain\MonitorRepository;
use Mario\Uptime\Tests\Utils\Infrastructure\UnitTestCase;
use Mockery;
use Mockery\MockInterface;

class MonitorUnitTestHelper extends UnitTestCase
{

    private MonitorRepository|null $repository = null;

    public function nextIdentity(int $id): void
    {
        $this->repository()
            ->shouldReceive('nextIdentity')
            ->andReturn($id);
    }

    protected function save(Monitor $monitor): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with(Mockery::on(function (Monitor $argument) use ($monitor) {
                return $argument->equals($monitor);
            }))
            ->once();
    }

    protected function find(int $id, ?Monitor $monitor): void
    {
        $this->repository()
            ->shouldReceive('byId')
            ->with($this->equalTo($id))
            ->andReturn($monitor);
    }

    protected function all(array $monitors): void
    {
        $this->repository()
            ->shouldReceive('all')
            ->andReturn($monitors);
    }

    protected function delete(Monitor $monitor): void
    {
        $this->repository()
            ->shouldReceive('delete')
            ->with($this->equalTo($monitor))
            ->once();
    }

    protected function repository(): MockInterface
    {
        return $this->repository ??= $this->mock(MonitorRepository::class);

    }
}
