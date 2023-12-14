<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Models\User;

class UserField implements FieldResolverInterface
{
    public function set($value): ?string
    {
        return $value;
    }

    public function get($value, $field = null): ?array
    {
        if ($value == null) {
            return null;
        }
        return User::find($value)->toArray();
    }
}
