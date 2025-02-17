<?php

namespace MarioDevv\Uptime\Monitoring\Application\Search;

use CodelyTv\Criteria\Criteria;
use MarioDevv\Uptime\Monitoring\Application\MonitorAssemblerInterface;
use MarioDevv\Uptime\Monitoring\Domain\MonitorRepository;

class SearchMonitors
{

    private MonitorRepository         $repository;
    private MonitorAssemblerInterface $assembler;

    public function __construct(MonitorRepository $repository, MonitorAssemblerInterface $assembler)
    {
        $this->repository = $repository;
        $this->assembler  = $assembler;
    }

    public function __invoke(Criteria $criteria): array
    {

        $monitors = $this->repository->matching($criteria);

        return array_map(
            fn($monitor) => $this->assembler->assemble($monitor),
            $monitors
        );


    }

}
