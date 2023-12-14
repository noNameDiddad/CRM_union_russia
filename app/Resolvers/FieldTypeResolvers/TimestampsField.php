<?php

namespace App\Resolvers\FieldTypeResolvers;

class TimestampsField implements FieldResolverInterface
{
    public function set($value): ?string
    {
        return $value;
    }

    public function get($value, $field = null): ?string
    {
        return $value;
    }
}
