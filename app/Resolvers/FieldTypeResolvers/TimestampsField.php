<?php

namespace App\Resolvers\FieldTypeResolvers;

class TimestampsField implements FieldResolverInterface
{
    public function set($value, $field = null): ?string
    {
        return $value;
    }

    public function get($value, $field = null, $isFormatted = true, $current_instance = null): ?string
    {
        return $value;
    }
}
