<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Models\EntityFieldFixedValue;

class TimestampsField implements FieldResolverInterface
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    public function set($value): ?string
    {
        return $value;
    }

    public function get($value): ?string
    {
        return $value;
    }
}
