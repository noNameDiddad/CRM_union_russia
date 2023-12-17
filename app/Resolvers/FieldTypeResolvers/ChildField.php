<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Helpers\FormatterHelper;
use App\Services\EntityService;
use App\Services\EntityValueService;

class ChildField implements FieldResolverInterface
{

    public function set($value, $field = null): ?string
    {
        return $value;
    }

    public function get($value, $field = null, $isFormatted = true, $current_instance = null): ?array
    {
        $childEntity = EntityService::getByHash($value);
        $service = new EntityValueService($childEntity);

        $childs = $service->getAllByParent(EntityService::getById($current_instance->entity_id)->hash, $current_instance->_id);

        $instanses = [];
        foreach($childs as $unit) {

            $instanses[] = $isFormatted ?[
                'id' =>  $unit->id,
                'value' => FormatterHelper::getShortOutput($unit, $childEntity->short_output)
            ] : $unit->toArray();
        }
        return $instanses;
    }
}
