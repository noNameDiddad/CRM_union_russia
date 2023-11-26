<?php

namespace App\Helpers;

use App\Enums\FieldTypeEnum;
use App\Models\EntityFieldFixedValue;
use App\Models\User;
use App\Repositories\EntityFieldRepository;

class EntityValueSeederHelper
{

    public static function generateData($entity_id, $fields): array
    {
        $data = [];
        foreach ($fields as $fieldName => $field) {
            $data[$fieldName] = self::generateField($field['id'], $field['type']);
        }

        return $data;
    }

    public static function generateField($field_id, $type)
    {
        if ($type == 'User') {
            dd($field_id, $type);
        }
        return match ($type) {
            FieldTypeEnum::String->value => fake()->word,
            FieldTypeEnum::Integer->value => fake()->numberBetween(1, 1000),
//            FieldTypeEnum::File->value =>
            FieldTypeEnum::User->value => User::first()->id ?? null,
            FieldTypeEnum::Timestamps->value => now()->toString(),
            FieldTypeEnum::Select->value => EntityFieldFixedValue::where('entity_field_id', $field_id)->inRandomOrder()->first()->id,
//            FieldTypeEnum::MultiSelect->value =>
            FieldTypeEnum::Boolean->value => fake()->boolean
        };
    }
}
