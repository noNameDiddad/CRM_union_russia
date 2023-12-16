<?php

namespace App\Resolvers\FieldTypeResolvers;

class EmailField implements FieldResolverInterface
{
    public function set($value): ?string
    {
        return json_encode($value);
    }

    public function get($value, $field = null, $isFormatted = true): ?string
    {
        return json_decode($value);
    }
}
