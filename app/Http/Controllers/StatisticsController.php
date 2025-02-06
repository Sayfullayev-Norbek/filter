<?php

namespace App\Http\Controllers;

use App\Services\StatisticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    protected $statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function filteredStatistics(Request $request): JsonResponse
    {
        $filters = $request->only(['type', 'year', 'month']);
        $statistics = $this->statisticsService->getStatistics($filters);

        return $this->response($statistics);
    }

    /**
     * @return JsonResponse
     */
    public function generalStatistics(): JsonResponse
    {
        return $this->response($this->statisticsService->generalStatistics());
    }

    public function byTypeStatistics(): JsonResponse
    {
        return $this->response($this->statisticsService->byTypeStatistics());
    }

    public function byUserStatistics(): JsonResponse
    {
        return $this->response($this->statisticsService->byUserStatistics());
    }

    public function topUsersStatistics()
    {
        return $this->response($this->statisticsService->topUsersStatistics());
    }
}
