<?php

namespace MarioDevv\Uptime\Monitor\Domain;

use CodelyTv\Criteria\Criteria;

interface MonitorRepository
{

    public function nextIdentity(): int;

    /**
     * @return Monitor[]
     */
    public function all(): array;

    public function matching(Criteria $criteria);

    public function byId(int $id): ?Monitor;

    public function save(Monitor $monitor): void;

    public function delete(Monitor $monitor): void;



}
