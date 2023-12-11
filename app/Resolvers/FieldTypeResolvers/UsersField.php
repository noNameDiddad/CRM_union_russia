<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Models\EntityFieldFixedValue;
use App\Models\User;

class UsersField implements FieldResolverInterface
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    public function set($value): ?array
    {
        return $value;
    }

    public function get($value, $field = null): ?array
    {
        if ($value == null) {
            return null;
        }

        $result = $result[] = User::whereIn('id', $value)->get();

        return $result->toArray();
    }
}
