<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Data\EntityValueFieldGetData;
use App\Helpers\FormatterHelper;
use App\Services\EntityService;
use App\Services\EntityValueService;

class ChildField implements FieldResolverInterface
{

    public function set($value, $field = null): ?string
    {
        return $value;
    }

    public function get(EntityValueFieldGetData $data): ?array
    {
        $childEntity = EntityService::getByHash($data->value);
        $service = new EntityValueService($childEntity);
        $children = $service->getAllByParent(EntityService::getById($data->currentEntityValue->entity_id)->hash, $data->currentEntityValue->_id);

        $instanses = [];
        foreach($children as $unit) {

            $instanses[] = $data->isFormatted ?[
                'id' =>  $unit->id,
                'value' => FormatterHelper::getShortOutput($unit, $childEntity->short_output)
            ] : $unit->toArray();
        }
        return $instanses;
    }
}
