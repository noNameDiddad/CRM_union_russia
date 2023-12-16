<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Models\User;

class UsersField implements FieldResolverInterface
{
    public function set($value, $field = null): ?array
    {
        return $value;
    }

    public function get($value, $field = null, $isFormatted = true, $current_instance = null): ?array
    {
        if ($value == null) {
            return null;
        }
        $users = User::whereIn('id', $value)->get();
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
