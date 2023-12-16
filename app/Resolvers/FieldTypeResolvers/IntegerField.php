<?php

namespace App\Resolvers\FieldTypeResolvers;

class IntegerField implements FieldResolverInterface
{
    public function set($value): ?int
    {
        return $value;
    }

    public function get($value, $field = null, $isFormatted = true): ?int
    {
        return $value;
    }
}
