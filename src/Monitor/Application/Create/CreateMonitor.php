<?php
declare(strict_types=1);

namespace MarioDevv\Uptime\Monitor\Application\Create;

use MarioDevv\Uptime\Monitor\Domain\Monitor;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

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
            $this->repository->nextIdentity(),
            $request->url(),
            $request->interval(),
            $request->timeOut()
        );

        $this->repository->save($monitor);
    }

}
