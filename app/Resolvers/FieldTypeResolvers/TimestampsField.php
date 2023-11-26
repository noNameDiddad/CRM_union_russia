<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Models\EntityFieldFixedValue;

class TimestampsField implements FieldResolverInterface
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    public function set($value): string
    {
        return json_encode($value);
    }

    public function get($value): array
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
