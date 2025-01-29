<?php

namespace Mario\Uptime\Monitor\Domain;

interface MonitorRepository
{

    public function nextIdentity(): int;

    /**
     * @return Monitor[]
     */
    public function all(): array;

    public function byId(int $id): ?Monitor;

    public function save(Monitor $monitor): void;

    public function delete(Monitor $monitor): void;


}
