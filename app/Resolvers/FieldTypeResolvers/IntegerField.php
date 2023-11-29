<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Models\EntityFieldFixedValue;

class IntegerField implements FieldResolverInterface
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    public function set($value): ?int
    {
        return $value;
    }

    public function get($value, $field = null): ?int
    {
        return $value;
    }
}
