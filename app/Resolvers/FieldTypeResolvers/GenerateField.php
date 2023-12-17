<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Data\EntityValueFieldGetData;

class GenerateField implements FieldResolverInterface
{
    public function set($value, $field = null): ?string
    {
        return $value;
    }

    public function get(EntityValueFieldGetData $data): ?string
    {
        return $data->value;
    }
}
