<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Models\EntityFieldFixedValue;

class PriorityField implements FieldResolverInterface
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    public function set($value): ?string
    {
        return $value;
    }

    public function get($value, $field = null): ?string
    {
        return $value;
    }
}
