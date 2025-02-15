<?php

namespace MarioDevv\Uptime\Monitor\Application\Ping;

use MarioDevv\Uptime\Monitor\Domain\MonitorNotFoundException;
use MarioDevv\Uptime\Monitor\Domain\MonitorPingService;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class PingMonitor
{

    private MonitorRepository  $repository;
    private MonitorPingService $pingService;

    public function __construct(MonitorRepository $repository, MonitorPingService $pingService)
    {
        $this->repository  = $repository;
        $this->pingService = $pingService;
    }


    /**
     * @throws MonitorNotFoundException
     */
    public function __invoke(PingMonitorRequest $request): void
    {

        $monitor = $this->repository->byId($request->id());

        if (null === $monitor) {
            throw new MonitorNotFoundException($request->id());
        }

        $monitor->ping($this->pingService);

        $this->repository->save($monitor);

    }


}
