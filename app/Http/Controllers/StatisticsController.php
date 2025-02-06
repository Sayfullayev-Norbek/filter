<?php

namespace App\Http\Controllers;

use App\Services\StatisticsService;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    protected $statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    public function filteredStatistics(Request $request)
    {
        $filters = $request->only(['type', 'year', 'month']);
        $statistics = $this->statisticsService->getStatistics($filters);

        return $this->response($statistics);
    }
}
