<?php

namespace MarioDevv\Uptime\Monitor\Application\Check;

use MarioDevv\Uptime\Monitor\Domain\MonitorNotifier;
use MarioDevv\Uptime\Monitor\Domain\MonitorPingService;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class CheckMonitors
{

    private MonitorRepository $repository;
    private MonitorPingService $pingService;
    private MonitorNotifier $notifier;

    public function __construct(
        MonitorRepository $repository,
        MonitorPingService $pingService,
        MonitorNotifier $notifier
    )
    {
        $this->repository  = $repository;
        $this->pingService = $pingService;
        $this->notifier    = $notifier;
    }

    public function __invoke(): void
    {

        $array = $this->repository->all();

        foreach ($array as $monitor) {

            $monitor->ping($this->pingService);

            if ($monitor->isSecondConsecutiveFailure()) {
                $this->notifier->down($monitor);
            }

            $this->repository->save($monitor);

        }

    }

}
