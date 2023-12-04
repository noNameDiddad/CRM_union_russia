<?php

namespace App\Services;

use App\Enums\FieldTypeEnum;
use App\Helpers\EntityFieldHelper;
use App\Resolvers\FieldTypeResolvers\IntegerField;
use App\Resolvers\FieldTypeResolvers\ObjectField;
use App\Resolvers\FieldTypeResolvers\RelationField;
use App\Resolvers\FieldTypeResolvers\SelectField;
use App\Resolvers\FieldTypeResolvers\StageField;
use App\Resolvers\FieldTypeResolvers\StringField;
use App\Resolvers\FieldTypeResolvers\TimestampsField;
use App\Resolvers\FieldTypeResolvers\UserField;

class FieldTypeService extends FieldService
{
    protected const FIELDSTYPES = [
        FieldTypeEnum::String->value => StringField::class,
        FieldTypeEnum::Select->value => SelectField::class,
        FieldTypeEnum::User->value => UserField::class,
        FieldTypeEnum::Integer->value => IntegerField::class,
        FieldTypeEnum::Timestamps->value => TimestampsField::class,
        FieldTypeEnum::Relation->value => RelationField::class,
        FieldTypeEnum::Object->value => ObjectField::class,
        FieldTypeEnum::Stage->value => StageField::class,
    ];

    public static function getClassForFieldType(string $fieldType): ?string
    {
        return self::FIELDSTYPES[$fieldType] ?? null;
    }

    public function dataFieldTypeResolve(array $data): array
    {
        $resolvedData['entity_id'] = $data['entity_id'];

        $fields = app(EntityFieldHelper::class)->getFields($data['entity_id']);
        unset($data['entity_id']);

        foreach ($data as $key => $value) {
            if (!isset($fields[$key])) {
                continue;
            }
            $resolvedData[$key] = app(static::getClassForFieldType($fields[$key]['type']))->set($value);
        }

        return $resolvedData;
    }
}
