<?php

namespace App\Repositories;

use App\Models\TrafficLog;

class TrafficLogRepository
{
    /**
     * Creates a data in the table TrafficLog
     * 
     * @param $data
     * 
     * @return TrafficLog
     */
    public function create(array $data)
    {
        return TrafficLog::create($data);
    }
}
