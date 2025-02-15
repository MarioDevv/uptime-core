<?php

namespace MarioDevv\Uptime\Monitor\Domain;

interface MonitorNotifier
{
    public function down(Monitor $monitor): void;
}