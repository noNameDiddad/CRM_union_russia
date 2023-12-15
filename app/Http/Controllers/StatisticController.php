<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatisticResource;
use App\Models\Entity;
use App\Models\StatisticFormat;
use App\Services\EntityValueService;

class StatisticController extends Controller
{
    private EntityValueService $service;

    public function getStatistics($action)
    {
        $format = StatisticFormat::where('action', $action)->first();

    }
}
