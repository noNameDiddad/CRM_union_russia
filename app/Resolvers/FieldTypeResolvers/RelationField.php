<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Services\EntityValueService;

class RelationField implements FieldResolverInterface
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    public function set($value): ?string
    {
        return $value;
    }

    public function get($value, $field = null): ?array
    {
        $entity_table = "table_" . $field['relateTo'];
        $service = new EntityValueService($entity_table);

        $instanse = $service->show($value);

        return $instanse->toArray();
    }
}
