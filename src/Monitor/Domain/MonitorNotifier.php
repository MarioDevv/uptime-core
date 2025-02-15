<?php

namespace MarioDevv\Uptime\Monitor\Domain;

interface MonitorNotifier
{
    public function notify(Monitor $monitor): void;
}