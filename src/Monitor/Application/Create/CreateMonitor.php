<?php

namespace Mario\Uptime\Monitor\Application\Create;

use Mario\Uptime\Monitor\Domain\Monitor;
use Mario\Uptime\Monitor\Domain\MonitorRepository;

class CreateMonitor
{

    private MonitorRepository $repository;

    public function __construct(MonitorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateMonitorRequest $request): void
    {

        $monitor = Monitor::create(
            $request->url(),
            $request->interval(),
            $request->state(),
            $request->timeOut()
        );

        $monitor->ping();

        $this->repository->save($monitor);
    }

}