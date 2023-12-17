<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Data\EntityValueFieldGetData;
use App\Helpers\FormatterHelper;
use App\Models\User;

class UserField implements FieldResolverInterface
{
    public function set($value, $field = null): ?string
    {
        return $value;
    }

    public function get(EntityValueFieldGetData $data): ?array
    {
        if ($data->value == null) {
            return null;
        }
        $user =  User::find($data->value);
        return [
            'id' => $user->id,
            'value' => $user->name
        ];
    }
}
