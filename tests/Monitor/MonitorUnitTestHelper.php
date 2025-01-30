<?php

namespace MarioDevv\Uptime\Tests\Monitor;

use CodelyTv\Criteria\Criteria;
use MarioDevv\Uptime\Monitor\Application\MonitorAssemblerInterface;
use MarioDevv\Uptime\Monitor\Domain\Monitor;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;
use MarioDevv\Uptime\Tests\Utils\Infrastructure\UnitTestCase;
use Mockery;
use Mockery\MockInterface;

class MonitorUnitTestHelper extends UnitTestCase
{

    private MonitorRepository|null $repository = null;
    private MonitorAssemblerInterface|null $assembler = null;

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
            ->with($this->equalTo($monitor))
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

    public function matching(Criteria $criteria, array $monitors): void
    {
        $this->repository()
            ->shouldReceive('matching')
            ->with($this->equalTo($criteria))
            ->andReturn($monitors);
    }

    protected function delete(Monitor $monitor): void
    {
        $this->repository()
            ->shouldReceive('delete')
            ->with($this->equalTo($monitor))
            ->once();
    }

    protected function assemble(Monitor $monitor): void
    {
        $this->assembler()
            ->shouldReceive('assemble')
            ->with($this->equalTo($monitor));
    }

    protected function repository(): MockInterface
    {
        return $this->repository ??= $this->mock(MonitorRepository::class);
    }

    protected function assembler(): MockInterface
    {
        return $this->assembler ??= $this->mock(MonitorAssemblerInterface::class);
    }
}
