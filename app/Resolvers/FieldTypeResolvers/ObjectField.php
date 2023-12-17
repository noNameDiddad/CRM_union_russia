<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Data\EntityValueFieldGetData;

class ObjectField implements FieldResolverInterface
{
    public function set($value, $field = null): ?string
    {
        return json_encode($value);
    }

    public function get(EntityValueFieldGetData $data): ?array
    {
        $object = json_decode($data->value);
        return [
            'value' => $object->value,
            'type' => $object->type
        ];
    }
}
