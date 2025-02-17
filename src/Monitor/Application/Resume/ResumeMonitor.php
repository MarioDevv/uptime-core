<?php

namespace MarioDevv\Uptime\Monitor\Application\Resume;

use MarioDevv\Uptime\Monitor\Domain\MonitorNotFoundException;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class ResumeMonitor
{

    private MonitorRepository  $repository;

    public function __construct(MonitorRepository $repository)
    {
        $this->repository  = $repository;
    }

    /**
     * @throws MonitorNotFoundException
     */
    public function __invoke(ResumeMonitorRequest $request): void
    {
        $monitor = $this->repository->byId($request->id());

        if (null === $monitor) {
            throw new MonitorNotFoundException($request->id());
        }

        $monitor->resume();

        $this->repository->save($monitor);
    }

}
