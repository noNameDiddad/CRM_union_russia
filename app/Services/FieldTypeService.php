<?php

namespace App\Services;

use App\Enums\FieldTypeEnum;
use App\Helpers\EntityFieldHelper;
use App\Repositories\EntityFieldRepository;
use App\Resolvers\FieldTypeResolvers\BooleanField;
use App\Resolvers\FieldTypeResolvers\EmailField;
use App\Resolvers\FieldTypeResolvers\FileField;
use App\Resolvers\FieldTypeResolvers\IntegerField;
use App\Resolvers\FieldTypeResolvers\ManyRelationField;
use App\Resolvers\FieldTypeResolvers\ObjectField;
use App\Resolvers\FieldTypeResolvers\PhoneNumberField;
use App\Resolvers\FieldTypeResolvers\PriorityField;
use App\Resolvers\FieldTypeResolvers\RelationField;
use App\Resolvers\FieldTypeResolvers\SelectField;
use App\Resolvers\FieldTypeResolvers\StageField;
use App\Resolvers\FieldTypeResolvers\StringField;
use App\Resolvers\FieldTypeResolvers\TimestampsField;
use App\Resolvers\FieldTypeResolvers\UserField;
use App\Resolvers\FieldTypeResolvers\UsersField;

class FieldTypeService extends FieldService
{
    protected const FIELDSTYPES = [
        FieldTypeEnum::String->value => StringField::class,
        FieldTypeEnum::Select->value => SelectField::class,
        FieldTypeEnum::User->value => UserField::class,
        FieldTypeEnum::Users->value => UsersField::class,
        FieldTypeEnum::Integer->value => IntegerField::class,
        FieldTypeEnum::Timestamps->value => TimestampsField::class,
        FieldTypeEnum::Relation->value => RelationField::class,
        FieldTypeEnum::ManyRelation->value => ManyRelationField::class,
        FieldTypeEnum::Object->value => ObjectField::class,
        FieldTypeEnum::Stage->value => StageField::class,
        FieldTypeEnum::File->value => FileField::class,
        FieldTypeEnum::Boolean->value => BooleanField::class,
        FieldTypeEnum::Priority->value => PriorityField::class,
        FieldTypeEnum::PhoneNumber->value => PhoneNumberField::class,
        FieldTypeEnum::Email->value => EmailField::class,
    ];

    public static function getClassForFieldType(string $fieldType): ?string
    {
        return self::FIELDSTYPES[$fieldType] ?? null;
    }

    public function dataFieldTypeResolve(array $data, $action = 'create'): array
    {
        $resolvedData['entity_id'] = $data['entity_id'];

        $fields = app(EntityFieldHelper::class)->getFields($data['entity_id']);
        $stadiaKey = collect($fields)->where('type', FieldTypeEnum::Stage->value)->keys()->first();

        if ( $stadiaKey !== null && !isset($data[$stadiaKey]) && $action == 'create') {
            $resolvedData[$stadiaKey] = app(EntityFieldRepository::class)->getFirstStageId($data['entity_id'], $stadiaKey);
        }

        foreach ($data as $key => $value) {
            if (!isset($fields[$key])) {
                continue;
            }
            $resolvedData[$key] = app(static::getClassForFieldType($fields[$key]['type']))->set($value);
        }

        return $resolvedData;
    }
}
