<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\TrafficLogService;

class TrafficController extends Controller
{
    protected $trafficLogService;

    public function __construct(TrafficLogService $trafficLogService)
    {
        $this->trafficLogService = $trafficLogService;
    }

    /**
     * Procedure for creating new record in the db
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function logTraffic(Request $request) : JsonResponse
    {
        $validatedData = $request->validate([
            'status' => 'required|in:green,yellow,red',
            'message' => 'required|string'
        ]);

        $data = $this->trafficLogService->logTraffic($validatedData);

        return response()->json(['result' => $data]);
    }
}
