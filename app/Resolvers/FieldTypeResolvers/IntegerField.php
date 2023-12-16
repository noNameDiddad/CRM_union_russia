<?php

namespace App\Resolvers\FieldTypeResolvers;

class IntegerField implements FieldResolverInterface
{
    public function set($value, $field = null): ?int
    {
        return $value;
    }

    public function get($value, $field = null, $isFormatted = true, $current_instance = null): ?int
    {
        return $value;
    }
}
