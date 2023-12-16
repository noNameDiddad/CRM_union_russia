<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Models\EntityFieldFixedValue;

class StageField implements FieldResolverInterface
{
    public function set($value): ?string
    {
        return $value;
    }

    public function get($value, $field = null, $isFormatted = true): ?array
    {
        $instance = EntityFieldFixedValue::find($value);
        if ($value == null) {
            return [];
        }
        return [
            'id' => $instance->id,
            'value' => $instance->value
        ];
    }
}
