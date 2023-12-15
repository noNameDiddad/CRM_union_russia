<?php

namespace App\Resolvers\FieldTypeResolvers;

class AddressField implements FieldResolverInterface
{

    public function set($value): ?string
    {
        return $value;
    }

    public function get($value, $field = null): ?array
    {
        return $value;
    }
}
