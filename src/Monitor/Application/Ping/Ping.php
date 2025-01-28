<?php

namespace Mario\Uptime\Monitor\Application\Ping;
use Mario\Uptime\Monitor\Domain\MonitorRepository;

class Ping
{

    private MonitorRepository $repository;

    public function __construct(MonitorRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @throws \Exception
     */
    public function __invoke(PingRequest $request): void
    {

        $monitor = $this->repository->byId($request->id());

        if (null === $monitor) {
            throw new \Exception('Monitor not found');
        }

        $monitor->ping();

        $this->repository->save($monitor);


    }


}