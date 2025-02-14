<?php

namespace MarioDevv\Uptime\Monitor\Application\Count;

use CodelyTv\Criteria\Criteria;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class CountMonitors
{

    private MonitorRepository $repository;

    public function __construct(MonitorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Criteria $criteria): int
    {
        return $this->repository->count($criteria);
    }

}
