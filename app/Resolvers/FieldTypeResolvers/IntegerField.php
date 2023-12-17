<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Data\EntityValueFieldGetData;

class IntegerField implements FieldResolverInterface
{
    public function set($value, $field = null): ?int
    {
        return $value;
    }

    public function get(EntityValueFieldGetData $data): ?string
    {
        return $data->value;
    }
}
