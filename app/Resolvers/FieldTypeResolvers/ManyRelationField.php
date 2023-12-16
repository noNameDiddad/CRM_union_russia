<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Helpers\FormatterHelper;
use App\Services\EntityService;
use App\Services\EntityValueService;

class ManyRelationField implements FieldResolverInterface
{
    public function set($value): ?string
    {
        return $value;

    }

    public function get($value, $field = null, $isFormatted = true): ?array
    {
        $entity_table = "table_" . $field['relateTo'];
        $service = new EntityValueService($entity_table);
        $entity = EntityService::getByHash($field['relateTo']);
        $elements = $service->repository->whereIn('_id', json_decode($value));

        $instanses = [];
        foreach($elements as $unit) {

            $instanses[] = $isFormatted ?[
                'id' =>  $unit->id,
                'value' => FormatterHelper::getShortOutput($unit, $entity->short_output)
            ] : $unit->toArray();
        }

        return $instanses;
    }
}
