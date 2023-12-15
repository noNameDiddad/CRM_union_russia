<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Helpers\EntityFieldHelper;
use App\Helpers\FormatterHelper;
use App\Services\EntityValueService;

class RelationField implements FieldResolverInterface
{

    public function set($value): ?string
    {
        return $value;
    }

    public function get($value, $field = null): ?array
    {
        $entity_table = "table_" . $field['relateTo'];
        $service = new EntityValueService($entity_table);

        $instance = $service->show($value);

        return [
            'id' => $instance->id,
            'value' => FormatterHelper::getShortOutput($instance, $field)
        ];
    }
}
