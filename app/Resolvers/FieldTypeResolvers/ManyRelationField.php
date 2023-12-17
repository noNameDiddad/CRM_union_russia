<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Data\EntityValueFieldGetData;
use App\Helpers\FormatterHelper;
use App\Services\EntityService;
use App\Services\EntityValueService;

class ManyRelationField implements FieldResolverInterface
{
    public function set($value, $field = null): ?string
    {
        return $value;

    }

    public function get(EntityValueFieldGetData $data): ?array
    {
        $service = new EntityValueService(EntityService::getByHash($data->field['relateTo']));
        $entity = EntityService::getByHash($data->field['relateTo']);
        $elements = $service->repository->whereIn('_id', json_decode($data->value));

        $instanses = [];
        foreach($elements as $unit) {

            $instanses[] = $data->isFormatted ?[
                'id' =>  $unit->id,
                'value' => FormatterHelper::getShortOutput($unit, $entity->short_output)
            ] : $unit->toArray();
        }

        return $instanses;
    }
}
