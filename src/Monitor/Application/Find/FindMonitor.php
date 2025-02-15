<?php

namespace MarioDevv\Uptime\Monitor\Application\Find;

use MarioDevv\Uptime\Monitor\Application\MonitorAssemblerInterface;
use MarioDevv\Uptime\Monitor\Domain\MonitorNotFoundException;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

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