<?php

namespace App\Helpers;

use App\Data\FieldFilterData;
use App\Repositories\FieldFilterRepository;

class FieldFilterHelper
{
    public static function filterData($data,$entity_id):array
    {
        $filteredData = [];
        $filters = FieldFilterData::from(app(FieldFilterRepository::class)
            ->where(['entity_id' => $entity_id])
            ->first()->toArray())->fields;

        foreach ($data as $item) {
            if ($filters[$item->hash]) {
                $filteredData[] = $item;
            }
        }
        return $filteredData;
    }
}
