<?php

namespace App\Helpers;

use App\Enums\FieldTypeEnum;
use App\Models\EntityFieldFixedValue;
use App\Models\User;
use App\Repositories\EntityFieldRepository;
use App\Services\EntityValueService;

class EntityValueSeederHelper
{

    public static function generateData($entity_id, $fields): array
    {
        $data = [];
        foreach ($fields as $fieldName => $field) {
            $data[$fieldName] = self::generateField($field['id'], $field['type'], $field['relateTo']);
        }

        return $data;
    }

    public static function generateField($field_id, $type, $relateTo = null): mixed
    {
        return match ($type) {
            FieldTypeEnum::String->value => fake()->word,
            FieldTypeEnum::Integer->value => fake()->numberBetween(1, 1000),
            FieldTypeEnum::File->value => self::generateFiles(),
            FieldTypeEnum::User->value => User::first()->id ?? null,
            FieldTypeEnum::Timestamps->value => now()->format('Y-m-d H:i:s'),
            FieldTypeEnum::Select->value, FieldTypeEnum::Stage->value => EntityFieldFixedValue::where('entity_field_id', $field_id)->inRandomOrder()->first()->id,
            FieldTypeEnum::Boolean->value => fake()->boolean,
            FieldTypeEnum::Relation->value => self::generateRelation($relateTo),
            FieldTypeEnum::Object->value => ['value' => fake()->word, 'type' => EntityFieldFixedValue::where('entity_field_id', $field_id)->inRandomOrder()->first()->value],
            FieldTypeEnum::Priority->value => fake()->unique()->randomNumber()
        };
    }

    public static function generateRelation($relateTo): string
    {
        $entity_table = "table_" . $relateTo;
        $service = new EntityValueService($entity_table);

        $randomId = $service->getRandomElement();

        return $randomId;
    }

    public static function generateFiles(): array
    {
        $result  = [];
        for ($i = 0; $i < 3; $i++) {
            $result[] = fake()->filePath();
        }

        return $result;
    }
}
