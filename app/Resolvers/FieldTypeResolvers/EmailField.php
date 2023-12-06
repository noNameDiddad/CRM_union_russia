<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Models\EntityFieldFixedValue;
use App\Models\User;

class EmailField implements FieldResolverInterface
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    public function set($value): ?string
    {
        return json_encode($value);
    }

    public function get($value, $field = null): ?string
    {
        return json_decode($value);
    }
}
