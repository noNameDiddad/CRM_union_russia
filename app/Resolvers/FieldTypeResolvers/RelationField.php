<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Helpers\FormatterHelper;
use App\Services\EntityService;
use App\Services\EntityValueService;

class RelationField implements FieldResolverInterface
{

    public function set($value, $field = null): ?string
    {
        return $value;
    }

    public function get($value, $field = null, $isFormatted = true, $current_instance = null): ?array
    {
        $service = new EntityValueService(EntityService::getByHash($field['relateTo']));

        $entity = EntityService::getByHash($field['relateTo']);
        $instance = $service->show($value);

        return $isFormatted ? [
            'id' => $instance->id,
            'value' => FormatterHelper::getShortOutput($instance, $entity->short_output)
        ] : $instance->toArray();
    }
}
