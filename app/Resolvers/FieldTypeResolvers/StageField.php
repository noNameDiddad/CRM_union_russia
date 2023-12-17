<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Data\EntityValueFieldGetData;
use App\Models\EntityFieldFixedValue;

class StageField implements FieldResolverInterface
{
    public function set($value, $field = null): ?string
    {
        return $value;
    }

    public function get(EntityValueFieldGetData $data): ?array
    {
        $instance = EntityFieldFixedValue::find($data->value);
        if ($data->value == null) {
            return [];
        }
        return [
            'id' => $instance->id,
            'value' => $instance->value
        ];
    }
}
