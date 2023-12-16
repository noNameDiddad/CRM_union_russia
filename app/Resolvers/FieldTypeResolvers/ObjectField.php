<?php

namespace App\Resolvers\FieldTypeResolvers;

class ObjectField implements FieldResolverInterface
{
    public function set($value, $field = null): ?string
    {
        return json_encode($value);
    }

    public function get($value, $field = null, $isFormatted = true, $current_instance = null): ?array
    {
        $object = json_decode($value);
        return [
            'value' => $object->value,
            'type' => $object->type
        ];
    }
}
