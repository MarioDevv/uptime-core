<?php

namespace MarioDevv\Uptime\Monitoring\Application\Find;

use MarioDevv\Uptime\Monitoring\Application\MonitorAssemblerInterface;
use MarioDevv\Uptime\Monitoring\Domain\MonitorNotFoundException;
use MarioDevv\Uptime\Monitoring\Domain\MonitorRepository;

class FindMonitor
{

    private MonitorRepository $repository;
    private MonitorAssemblerInterface $assembler;

    public function __construct(MonitorRepository $repository, MonitorAssemblerInterface $assembler)
    {
        $this->repository = $repository;
        $this->assembler = $assembler;
    }

    /**
     * @throws MonitorNotFoundException
     */
    public function __invoke(FindMonitorRequest $request)
    {
        $monitor = $this->repository->byId($request->id());

        if (null === $monitor) {
            throw new MonitorNotFoundException($request->id());
        }

        return $this->assembler->assemble($monitor);

    }


}