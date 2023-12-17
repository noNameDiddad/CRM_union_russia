<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Data\EntityValueFieldGetData;

class EmailField implements FieldResolverInterface
{
    public function set($value, $field = null): ?string
    {
        return json_encode($value);
    }

    public function get(EntityValueFieldGetData $data): ?bool
    {
        return json_encode($data->value);
    }
}
