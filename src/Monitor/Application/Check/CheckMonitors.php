<?php

namespace MarioDevv\Uptime\Monitor\Application\Check;

use CodelyTv\Criteria\Criteria;
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

    public function __invoke(Criteria $criteria): void
    {

        $array = $this->repository->matching($criteria);

        foreach ($array as $monitor) {

            $monitor->ping($this->pingService);

            $this->repository->save($monitor);

        }

    }

}
