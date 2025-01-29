<?php

namespace MarioDevv\Uptime\Monitor\Application\Delete;

use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class DeleteMonitor
{


    private MonitorRepository $repository;

    public function __construct(MonitorRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @throws \Exception
     */
    public function __invoke(DeleteMonitorRequest $request): void
    {

        $monitor = $this->repository->byId($request->id());

        if (null === $monitor) {
            throw new \Exception('Monitor not found');
        }

        $this->repository->delete($monitor);

    }


}
