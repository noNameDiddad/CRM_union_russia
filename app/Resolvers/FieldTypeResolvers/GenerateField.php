<?php

namespace App\Resolvers\FieldTypeResolvers;

class GenerateField implements FieldResolverInterface
{
    public function set($value): ?string
    {
        return $value;
    }

    public function get($value, $field = null, $isFormatted = true): ?string
    {
        return $value;
    }
}
