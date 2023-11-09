<?php

namespace App\Services;

use App\Enums\FieldTypeEnum;
use App\Resolvers\FieldTypeResolvers\StringField;

class FieldTypeService extends FieldService
{
    protected const FIELDSTYPES = [
        FieldTypeEnum::String->value => StringField::class,
    ];


    public function dataFieldTypeResolve(array $data): array
    {
        $resolvedData = [];
        foreach ($data as $key => $value) {
            $resolvedData[$key] = $this->resolveFieldType($value);
        }
        return $resolvedData;
    }
}
