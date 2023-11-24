<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatisticResource;
use App\Models\Entity;
use App\Services\EntityValueService;

class StatisticController extends Controller
{
    private EntityValueService $service;

    public function getStatistics(Entity $entity)
    {
        $entity_table = "table_" . $entity->hash;
        $this->service = new EntityValueService($entity_table);
        return StatisticResource::collection($this->service->getAllByEntity($entity));
    }
}
