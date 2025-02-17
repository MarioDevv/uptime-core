<?php
declare(strict_types=1);

namespace MarioDevv\Uptime\Monitor\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Monitor
{

    private int $id;
    private MonitorUrl $url;
    private MonitorInterval $interval;
    private MonitorState $state;
    private MonitorTimeOut $timeOut;
    private MonitorLastCheck $lastCheck;
    private MonitorSSLExpiration $sslExpiration;

    /**
     * @var Collection<MonitorHistory>
     */
    private Collection $history;

    public function __construct(
        int $id,
        MonitorUrl $url,
        MonitorInterval $interval,
        MonitorState $state,
        MonitorTimeOut $timeOut,
        MonitorLastCheck $lastCheck,
        MonitorSSLExpiration $sslExpiration,
    )
    {
        $this->id            = $id;
        $this->url           = $url;
        $this->interval      = $interval;
        $this->state         = $state;
        $this->timeOut       = $timeOut;
        $this->lastCheck     = $lastCheck;
        $this->sslExpiration = $sslExpiration;
        $this->history       = new ArrayCollection();
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

    public function sslExpiration(): MonitorSSLExpiration
    {
        return $this->sslExpiration;
    }


    public function shouldCheck(): bool
    {
        return $this->lastCheck->isOlderThan($this->interval);
    }

    public function ping(MonitorPingService $pingService): void
    {
        if (/*!$this->shouldCheck() ||*/ $this->state->value() === MonitorState::STOPPED) {
            return;
        }

        $pingInfo = $pingService->ping($this->url, $this->timeOut);

        $this->state         = MonitorState::fromHttpCode($pingInfo->httpStatusCode());
        $this->lastCheck     = MonitorLastCheck::now();
        $this->sslExpiration = new MonitorSSLExpiration($pingInfo->sslExpiration());

        $history = MonitorHistory::fromMonitor(
            $this,
            $pingInfo->httpStatusCode(),
            $pingInfo->responseTime()
        );

        $this->addHistory($history);

    }

    public function isSecondConsecutiveFailure(): bool
    {

        if ($this->history->count() < 2) {
            return false;
        }

        $lastTwo = array_values($this->history->slice(-2, 2));

        return $lastTwo[0]->isFailure() && $lastTwo[1]->isFailure();
    }

    public function stop(): void
    {
        $this->state = new MonitorState(MonitorState::STOPPED);
    }

    public function addHistory(MonitorHistory $history): void
    {
        $this->history->add($history);

        if ($this->history->count() > 20) {
            $this->history->remove($this->history->count() - 1);
        }
    }

    public function history(): array
    {
        return $this->history->toArray();
    }

    public function responseTimeAvg(): float
    {
        return $this->history->isEmpty()
            ? 0
            : array_sum($this->history->map(fn(MonitorHistory $history) => $history->responseTime())->toArray()) / $this->history->count();
    }

    public function responseTimeMax(): float
    {
        return $this->history->isEmpty()
            ? 0
            : max($this->history->map(fn(MonitorHistory $history) => $history->responseTime())->toArray());
    }

    public function responseTimeMin(): float
    {
        return $this->history->isEmpty()
            ? 0
            : min($this->history->map(fn(MonitorHistory $history) => $history->responseTime())->toArray());
    }


    public static function create(int $id, string $url, int $interval, int $timeOut): self
    {
        return new self(
            $id,
            new MonitorUrl($url),
            new MonitorInterval($interval),
            new MonitorState(MonitorState::UP),
            new MonitorTimeOut($timeOut),
            new MonitorLastCheck(null),
            new MonitorSSLExpiration(null)
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
