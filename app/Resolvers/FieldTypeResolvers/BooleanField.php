<?php

namespace App\Resolvers\FieldTypeResolvers;

class BooleanField implements FieldResolverInterface
{

    public function set($value, $field = null): ?string
    {
        return $value;
    }

    public function get($value, $field = null, $isFormatted = true, $current_instance = null): ?array
    {
        return $value;
    }
}
