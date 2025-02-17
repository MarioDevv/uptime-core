<?php

namespace MarioDevv\Uptime\Monitoring\Domain;

interface MonitorNotifier
{
    public function notify(Monitor $monitor): void;
}