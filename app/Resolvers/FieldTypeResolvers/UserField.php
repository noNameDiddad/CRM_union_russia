<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Helpers\FormatterHelper;
use App\Models\User;

class UserField implements FieldResolverInterface
{
    public function set($value, $field = null): ?string
    {
        return $value;
    }

    public function get($value, $field = null, $isFormatted = true, $current_instance = null): ?array
    {
        if ($value == null) {
            return null;
        }
        $user =  User::find($value);
        return [
            'id' => $user->id,
            'value' => $user->name
        ];
    }
}
