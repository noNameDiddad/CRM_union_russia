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
            $data[$fieldName] = self::generateField($field['id'], $field['type'], $field['relateTo'], $field['subType']);
        }

        return $data;
    }

    public static function generateField($field_id, $type, $relateTo = null, $subType = null): mixed
    {
        return match ($type) {
            FieldTypeEnum::String->value => fake()->word,
            FieldTypeEnum::Integer->value => fake()->numberBetween(1, 1000),
            FieldTypeEnum::File->value => "/" . fake()->word,
            FieldTypeEnum::User->value => User::first()->id ?? null,
            FieldTypeEnum::Users->value => fake()->randomElements(User::pluck('id')->toArray(), fake()->numberBetween(1, count(User::pluck('id')->toArray()))),
            FieldTypeEnum::Timestamps->value => now()->format('Y-m-d H:i:s'),
            FieldTypeEnum::Select->value, FieldTypeEnum::Stage->value => EntityFieldFixedValue::where('entity_field_id', $field_id)->inRandomOrder()->first()->id,
            FieldTypeEnum::Boolean->value => fake()->boolean,
            FieldTypeEnum::Relation->value => self::generateRelation($relateTo),
            FieldTypeEnum::ManyRelation->value => self::generateRelation($relateTo, 3),
            FieldTypeEnum::Object->value => ['value' => self::generateField($field_id, $subType), 'type' => EntityFieldFixedValue::where('entity_field_id', $field_id)->inRandomOrder()->first()->value],
            FieldTypeEnum::Priority->value => fake()->numberBetween(1, 100),
            FieldTypeEnum::PhoneNumber->value => fake()->phoneNumber,
            FieldTypeEnum::Email->value => fake()->email,
        };
    }

    public static function generateRelation($relateTo, $count = 1): string
    {
        $entity_table = "table_" . $relateTo;
        $service = new EntityValueService($entity_table);

        $randomId = $service->getRandomElement($count);

        return $randomId;
    }

//     public static function generateManyRelation($relateTo): array
//     {
//         $entity_table = "table_" . $relateTo;
//         $service = new EntityValueService($entity_table);
//         $randomIds = $service->getRandomElement(3)->toArray();

//         return $randomIds;
//     }
// }
}
