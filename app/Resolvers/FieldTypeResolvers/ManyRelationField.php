<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Services\EntityValueService;

class ManyRelationField implements FieldResolverInterface
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    public function set($value): ?array
    {
        return $value;
    }

    public function get($value, $field = null): ?array
    {
        $entity_table = "table_" . $field['relateTo'];
        $service = new EntityValueService($entity_table);

        $instanses = [];
        foreach($value as $unit) {
            $instanses[] = $service->show($unit);
        }

        return $instanses;
    }
}
