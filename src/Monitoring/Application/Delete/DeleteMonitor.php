<?php

namespace MarioDevv\Uptime\Monitoring\Application\Delete;

use MarioDevv\Uptime\Monitoring\Domain\MonitorNotFoundException;
use MarioDevv\Uptime\Monitoring\Domain\MonitorRepository;

class DeleteMonitor
{


    private MonitorRepository $repository;

    public function __construct(MonitorRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @throws MonitorNotFoundException
     */
    public function __invoke(DeleteMonitorRequest $request): void
    {

        $monitor = $this->repository->byId($request->id());

        if (null === $monitor) {
            throw new MonitorNotFoundException($request->id());
        }

        $this->repository->delete($monitor);

    }


}
