<?php

namespace MarioDevv\Uptime\Monitor\Application\Ping;

use MarioDevv\Uptime\Monitor\Domain\MonitorNotFoundException;
use MarioDevv\Uptime\Monitor\Domain\MonitorNotifier;
use MarioDevv\Uptime\Monitor\Domain\MonitorPingService;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class PingMonitor
{

    private MonitorRepository $repository;
    private MonitorPingService $pingService;
    private MonitorNotifier $notifier;

    public function __construct(
        MonitorRepository  $repository,
        MonitorPingService $pingService,
        MonitorNotifier    $notifier
    )
    {
        $this->repository  = $repository;
        $this->pingService = $pingService;
        $this->notifier    = $notifier;
    }


    /**
     * @throws MonitorNotFoundException
     */
    public function __invoke(PingMonitorRequest $request): void
    {

        $monitor = $this->repository->byId($request->id());

        if (null === $monitor) {
            throw new MonitorNotFoundException($request->id());
        }

        $monitor->ping($this->pingService);

        if ($monitor->isSecondConsecutiveFailure()) {
            $this->notifier->down($monitor);
        }

        $this->repository->save($monitor);

    }


}
