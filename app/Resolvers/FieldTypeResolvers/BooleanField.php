<?php

namespace App\Resolvers\FieldTypeResolvers;

class BooleanField implements FieldResolverInterface
{

    public function set($value): ?string
    {
        return $value;
    }

    public function get($value, $field = null, $isFormatted = true): ?array
    {
        return $value;
    }
}
