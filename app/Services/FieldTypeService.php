<?php

namespace App\Services;

use App\Enums\FieldTypeEnum;
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
}
