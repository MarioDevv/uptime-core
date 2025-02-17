<?php

namespace MarioDevv\Uptime\Monitoring\Domain\Model\Monitor;

use CodelyTv\Criteria\Criteria;

interface MonitorRepository
{

    public function nextIdentity(): int;

    /**
     * @return Monitor[]
     */
    public function all(): array;

    public function matching(Criteria $criteria): array;

    public function count(Criteria $criteria): int;

    public function byId(int $id): ?Monitor;

    public function save(Monitor $monitor): void;

    public function delete(Monitor $monitor): void;


}
