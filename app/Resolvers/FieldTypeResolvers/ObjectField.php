<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Models\EntityFieldFixedValue;
use App\Models\User;

class ObjectField implements FieldResolverInterface
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    public function set($value): ?string
    {
        return json_encode($value);
    }

    public function get($value, $field = null): ?array
    {
        $object = json_decode($value);
        return [
            'value' => $object->value,
            'type' => $object->type
        ];
    }
}
