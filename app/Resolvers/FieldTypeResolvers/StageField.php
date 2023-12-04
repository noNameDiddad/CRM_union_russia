<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Models\EntityFieldFixedValue;

class StageField implements FieldResolverInterface
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    public function set($value): ?string
    {
        return $value;
    }

    public function get($value, $field = null): ?array
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