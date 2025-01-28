<?php
declare(strict_types=1);

namespace Mario\Uptime\Monitor\Domain;

class Monitor
{

    private int $id;
    private MonitorUrl $url;
    private MonitorInterval $interval;
    private MonitorState $state;
    private MonitorTimeOut $timeOut;

    public function __construct(int $id, MonitorUrl $url, MonitorInterval $interval, MonitorState $state, MonitorTimeOut $timeOut)
    {
        $this->id       = $id;
        $this->url      = $url;
        $this->interval = $interval;
        $this->state    = $state;
        $this->timeOut  = $timeOut;
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

    public function ping(): void
    {

        $ch = curl_init($this->url->value());

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeOut->value());

        curl_exec($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $this->state = $this->checkIfHttpCodeIsCorrect($httpCode) ?
            new MonitorState(MonitorState::UP) :
            new MonitorState(MonitorState::DOWN);

    }

    public static function create(int $id, string $url, int $interval, int $timeOut): self
    {
        return new self(
            $id,
            new MonitorUrl($url),
            new MonitorInterval($interval),
            new MonitorState(MonitorState::UP),
            new MonitorTimeOut($timeOut)
        );
    }

    private function checkIfHttpCodeIsCorrect(int $httpCode): bool
    {
        return $httpCode >= 200 && $httpCode < 400;
    }

}