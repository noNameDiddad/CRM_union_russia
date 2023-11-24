<?php

namespace App\Resolvers\FieldTypeResolvers;

class StringField implements FieldResolverInterface
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    public function set($value): ?string
    {
        return $value;
    }

    public function get($value): ?string
    {
        return $value;
    }
}
