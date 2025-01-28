<?php

namespace Mario\Uptime\Monitor\Domain;

interface MonitorRepository
{

    public function byId(int $id): ?Monitor;

    public function save(Monitor $monitor): void;


}