<?php

namespace MarioDevv\Uptime\Monitoring\Application\CountMonitors;

use CodelyTv\Criteria\Criteria;
use MarioDevv\Uptime\Monitoring\Domain\Model\Monitor\MonitorRepository;

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
