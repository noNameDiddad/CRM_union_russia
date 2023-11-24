<?php

namespace App\Services;

use App\Enums\FieldTypeEnum;
use App\Helpers\EntityFieldHelper;
use App\Resolvers\FieldTypeResolvers\SelectField;
use App\Resolvers\FieldTypeResolvers\StringField;

class FieldTypeService extends FieldService
{
    protected const FIELDSTYPES = [
        FieldTypeEnum::String->value => StringField::class,
        FieldTypeEnum::Select->value => SelectField::class
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
            $resolvedData[$key] = app(static::getClassForFieldType($fields[$key]))->set($value);
        }

        return $resolvedData;
    }
}
