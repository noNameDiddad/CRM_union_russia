<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Models\EntityFieldFixedValue;
use App\Models\User;

class UserField implements FieldResolverInterface
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    public function set($value): ?string
    {
        return $value;
    }

    public function get($value): ?array
    {
        if ($value == null) {
            return null;
        }
        return User::find($value)->toArray();
    }
}
