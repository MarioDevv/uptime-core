<?php
declare(strict_types=1);

namespace Mario\Uptime\Monitor\Domain;

use DateTimeImmutable;

class Monitor
{

    private int $id;
    private MonitorUrl $url;
    private MonitorInterval $interval;
    private MonitorState $state;
    private MonitorTimeOut $timeOut;
    private MonitorLastCheck $lastCheck;

    public function __construct(
        int             $id,
        MonitorUrl      $url,
        MonitorInterval $interval,
        MonitorState    $state,
        MonitorTimeOut  $timeOut,
        MonitorLastCheck $lastCheck
    )
    {
        $this->id       = $id;
        $this->url      = $url;
        $this->interval = $interval;
        $this->state    = $state;
        $this->timeOut  = $timeOut;
        $this->lastCheck = $lastCheck;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function url(): MonitorUrl
    {
        return $this->url;
    }

    public function interval(): MonitorInterval
    {
        return $this->interval;
    }

    public function state(): MonitorState
    {
        return $this->state;
    }

    public function timeOut(): MonitorTimeOut
    {
        return $this->timeOut;
    }

    public function lastCheck(): MonitorLastCheck
    {
        return $this->lastCheck;
    }

    public function shouldCheck(): bool
    {
        return $this->lastCheck->isOlderThan($this->interval);
    }

    public function ping(MonitorPingService $pingService): void
    {
        if (!$this->shouldCheck() || $this->state->value() === MonitorState::STOPPED) {
            return;
        }

        $newState = $pingService->ping($this->url, $this->timeOut);

        $this->state = $newState;

        $this->lastCheck = MonitorLastCheck::now();

    }

    public static function create(int $id, string $url, int $interval, int $timeOut): self
    {
        return new self(
            $id,
            new MonitorUrl($url),
            new MonitorInterval($interval),
            new MonitorState(MonitorState::STOPPED),
            new MonitorTimeOut($timeOut),
            new MonitorLastCheck(null)
        );
    }


    public function equals(Monitor $other): bool
    {
        return $this->id === $other->id
            && $this->url->equals($other->url)
            && $this->interval->equals($other->interval)
            && $this->state->equals($other->state)
            && $this->timeOut->equals($other->timeOut);
    }

}
