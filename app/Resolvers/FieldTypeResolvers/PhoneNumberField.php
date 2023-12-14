<?php

namespace App\Resolvers\FieldTypeResolvers;

class PhoneNumberField implements FieldResolverInterface
{
    public function set($value): ?string
    {
        return json_encode($value);
    }

    public function get($value, $field = null): ?string
    {
        return json_decode($value);
    }
}
