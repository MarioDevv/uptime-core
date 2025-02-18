<?php

namespace MarioDevv\Uptime\Monitoring\Application\StopMonitor;

use MarioDevv\Uptime\Monitoring\Domain\Model\Monitor\MonitorNotFoundException;
use MarioDevv\Uptime\Monitoring\Domain\Model\Monitor\MonitorRepository;

class StopMonitor
{

    private MonitorRepository $repository;

    public function __construct(MonitorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws MonitorNotFoundException
     */
    public function __invoke(StopMonitorRequest $request): void
    {

        $monitor = $this->repository->byId($request->id());

        if (null === $monitor) {
            throw new MonitorNotFoundException($request->id());
        }

        $monitor->stop();

        $this->repository->save($monitor);

    }

}
