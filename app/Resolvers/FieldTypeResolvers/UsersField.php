<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Data\EntityValueFieldGetData;
use App\Models\User;

class UsersField implements FieldResolverInterface
{
    public function set($value, $field = null): ?array
    {
        return $value;
    }

    public function get(EntityValueFieldGetData $data): ?array
    {
        if ($data->value == null) {
            return null;
        }
        $users = User::whereIn('id', $data->value)->get();
        $result = [];
        foreach ($users as $user) {
            $result[] = [
                'id' => $user->id,
                'value' => $user->name
            ];
        }

        return $result;
    }
}
