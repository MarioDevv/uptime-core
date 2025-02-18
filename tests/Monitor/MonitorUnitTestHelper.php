<?php

namespace MarioDevv\Uptime\Tests\Monitor;

use CodelyTv\Criteria\Criteria;
use MarioDevv\Uptime\Monitoring\Application\MonitorAssemblerInterface;
use MarioDevv\Uptime\Monitoring\Domain\Monitor;
use MarioDevv\Uptime\Monitoring\Domain\MonitorNotifier;
use MarioDevv\Uptime\Monitoring\Domain\MonitorPingInformation;
use MarioDevv\Uptime\Monitoring\Domain\MonitorPingService;
use MarioDevv\Uptime\Monitoring\Domain\MonitorRepository;
use MarioDevv\Uptime\Monitoring\Domain\MonitorTimeOut;
use MarioDevv\Uptime\Monitoring\Domain\MonitorUrl;
use MarioDevv\Uptime\Tests\Utils\Infrastructure\UnitTestCase;
use Mockery;
use Mockery\MockInterface;

class MonitorUnitTestHelper extends UnitTestCase
{

    private MonitorRepository|null         $repository  = null;
    private MonitorPingService|null        $pingService = null;
    private MonitorAssemblerInterface|null $assembler   = null;
    private MonitorNotifier|null           $notifier    = null;

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
            ->with(Mockery::on(function ($value) use ($monitor) {
                return $monitor->equals($value);
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

    protected function matching(Criteria $criteria, array $monitors): void
    {
        $this->repository()
            ->shouldReceive('matching')
            ->with($this->equalTo($criteria))
            ->andReturn($monitors);
    }

    protected function countByCriteria(Criteria $criteria, int $count): void
    {
        $this->repository()
            ->shouldReceive('count')
            ->with($this->equalTo($criteria))
            ->andReturn($count);
    }


    protected function delete(Monitor $monitor): void
    {
        $this->repository()
            ->shouldReceive('delete')
            ->with($this->equalTo($monitor))
            ->once();
    }

    protected function ping(MonitorUrl $url, MonitorTimeOut $timeOut, MonitorPingInformation $information): void
    {
        $this->pingService()
            ->shouldReceive('ping')
            ->with(
                $this->equalTo($url),
                $this->equalTo($timeOut)
            )
            ->andReturn($information);
    }

    protected function assemble(Monitor $monitor): void
    {
        $this->assembler()
            ->shouldReceive('assemble')
            ->with($this->equalTo($monitor));
    }

    protected function wasNotified(Monitor $monitor): void
    {
        $this->notifier()
            ->shouldReceive('notify')
            ->with($this->equalTo($monitor))
            ->once();

    }

    protected function repository(): MockInterface
    {
        return $this->repository ??= $this->mock(MonitorRepository::class);
    }

    protected function pingService(): MockInterface
    {
        return $this->pingService ??= $this->mock(MonitorPingService::class);
    }

    protected function assembler(): MockInterface
    {
        return $this->assembler ??= $this->mock(MonitorAssemblerInterface::class);
    }

    protected function notifier(): MockInterface
    {
        return $this->notifier ??= $this->mock(MonitorNotifier::class);
    }
}
