<?php

namespace MarioDevv\Uptime\Monitoring\Application\Ping;

use MarioDevv\Uptime\Monitoring\Domain\MonitorNotFoundException;
use MarioDevv\Uptime\Monitoring\Domain\MonitorNotifier;
use MarioDevv\Uptime\Monitoring\Domain\MonitorPingService;
use MarioDevv\Uptime\Monitoring\Domain\MonitorRepository;

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
            $this->notifier->notify($monitor);
        }

        $this->repository->save($monitor);

    }


}
