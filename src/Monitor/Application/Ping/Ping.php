<?php

namespace MarioDevv\Uptime\Monitor\Application\Ping;

use MarioDevv\Uptime\Monitor\Domain\MonitorPingService;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class Ping
{

    private MonitorRepository  $repository;
    private MonitorPingService $pingService;

    public function __construct(MonitorRepository $repository, MonitorPingService $pingService)
    {
        $this->repository  = $repository;
        $this->pingService = $pingService;
    }


    /**
     * @throws \Exception
     */
    public function __invoke(PingRequest $request): void
    {

        $monitor = $this->repository->byId($request->id());

        if (null === $monitor) {
            throw new \Exception('Monitor not found');
        }

        $monitor->ping($this->pingService);

        $this->repository->save($monitor);


    }


}
