<?php

namespace App\Services;

use App\Repositories\TrafficLogRepository;

class TrafficLogService
{
    protected $trafficLogRepository;

    public function __construct(TrafficLogRepository $trafficLogRepository)
    {
        $this->trafficLogRepository = $trafficLogRepository;
    }

    /**
     * Use a Repository of traffic log for creating new record
     * 
     * @return mixed
     */
    public function logTraffic(array $data)
    {
        return $this->trafficLogRepository->create($data);
    }
}
