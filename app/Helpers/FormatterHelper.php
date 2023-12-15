<?php

namespace App\Helpers;

use App\Http\Resources\EntityValueResource;
use App\Models\StatisticFormat;
use App\Services\EntityValueService;
use App\Models\Entity;


class FormatterHelper
{

    private EntityValueService $service;

    public function getFormatted($format)
    {
        $entity = Entity::where('hash', $format->hash)->first();

        $entity_table = "table_" . $format->hash;
        $this->service = new EntityValueService($entity_table);

        return EntityValueResource::collection($this->service->getAllByEntity($entity));
    }
}
