<?php

namespace MarioDevv\Uptime\Monitor\Application\Check;

use MarioDevv\Uptime\Monitor\Domain\MonitorPingService;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class CheckMonitors
{

    private MonitorRepository  $repository;
    private MonitorPingService $pingService;

    public function __construct(
        MonitorRepository  $repository,
        MonitorPingService $pingService
    )
    {
        $this->repository  = $repository;
        $this->pingService = $pingService;
    }

    public function __invoke(): void
    {

        $array = $this->repository->all();

        foreach ($array as $monitor) {

            $monitor->ping($this->pingService);

            $this->repository->save($monitor);

        }

    }

}
