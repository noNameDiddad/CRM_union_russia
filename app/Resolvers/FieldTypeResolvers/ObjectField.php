<?php

namespace App\Resolvers\FieldTypeResolvers;

class ObjectField implements FieldResolverInterface
{
    public function set($value): ?string
    {
        return json_encode($value);
    }

    public function get($value, $field = null, $isFormatted = true): ?array
    {
        $object = json_decode($value);
        return [
            'value' => $object->value,
            'type' => $object->type
        ];
    }
}
