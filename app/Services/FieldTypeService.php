<?php

namespace App\Services;

use App\Enums\FieldTypeEnum;
use App\Enums\FieldValidationEnum;
use App\Helpers\EntityFieldHelper;
use App\Repositories\EntityFieldRepository;
use App\Resolvers\FieldTypeResolvers\AddressField;
use App\Resolvers\FieldTypeResolvers\BelongsToField;
use App\Resolvers\FieldTypeResolvers\BooleanField;
use App\Resolvers\FieldTypeResolvers\ChildField;
use App\Resolvers\FieldTypeResolvers\EmailField;
use App\Resolvers\FieldTypeResolvers\FileField;
use App\Resolvers\FieldTypeResolvers\GenerateField;
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
use App\Resolvers\ValidationResolvers\IssetRelation;
use App\Resolvers\ValidationResolvers\Required;
use Nette\Schema\ValidationException;

class FieldTypeService extends FieldService
{
    protected const FIELDS_TYPES = [
        FieldTypeEnum::String->value            => StringField::class,
        FieldTypeEnum::Select->value            => SelectField::class,
        FieldTypeEnum::User->value              => UserField::class,
        FieldTypeEnum::Generate->value          => GenerateField::class,
        FieldTypeEnum::Users->value             => UsersField::class,
        FieldTypeEnum::Integer->value           => IntegerField::class,
        FieldTypeEnum::Timestamps->value        => TimestampsField::class,
        FieldTypeEnum::Relation->value          => RelationField::class,
        FieldTypeEnum::ManyRelation->value      => ManyRelationField::class,
        FieldTypeEnum::Object->value            => ObjectField::class,
        FieldTypeEnum::Stage->value             => StageField::class,
        FieldTypeEnum::File->value              => FileField::class,
        FieldTypeEnum::Boolean->value           => BooleanField::class,
        FieldTypeEnum::BelongsTo->value         => BelongsToField::class,
        FieldTypeEnum::Child->value             => ChildField::class,
        FieldTypeEnum::Address->value           => AddressField::class,
        FieldTypeEnum::Priority->value          => PriorityField::class,
        FieldTypeEnum::PhoneNumber->value       => PhoneNumberField::class,
        FieldTypeEnum::Email->value             => EmailField::class,
    ];

    protected const FIELDS_VALIDATION_TYPES = [
        FieldValidationEnum::Required->value        => Required::class,
        FieldValidationEnum::IssetRelation->value   => IssetRelation::class,
    ];

    public static function getClassForFieldType(string $fieldType): ?string
    {
        return self::FIELDS_TYPES[$fieldType] ?? null;
    }

    public static function getClassForValidation(string $validationType): ?string
    {
        return self::FIELDS_VALIDATION_TYPES[$validationType] ?? null;
    }

    public function dataFieldTypeResolve(array $data, $action = 'create'): array
    {
        $resolvedData['entity_id'] = $data['entity_id'];

        $fields = app(EntityFieldHelper::class)->getFields($data['entity_id']);
        $stadiaKey = collect($fields)->where('type', FieldTypeEnum::Stage->value)->keys()->first();

        if ( $stadiaKey !== null && !isset($data[$stadiaKey]) && $action == 'create') {
            $resolvedData[$stadiaKey] = app(EntityFieldRepository::class)->getFirstStageId($data['entity_id'], $stadiaKey);
        }

//        $this->validateAll($fields, $data, $action);

        foreach ($data as $key => $value) {
            if (!isset($fields[$key])) {
                continue;
            }
            $resolvedData[$key] = app(static::getClassForFieldType($fields[$key]['type']))->set($value, $fields[$key]);
        }

        return $resolvedData;
    }


    private function validateAll($fields,$data, $action = 'create'): void
    {
        $errors = [];
        if ($action === 'update') {
            return;
        }
        foreach ($fields as $key => $field) {
            $value = $data[$key] ?? null;
            foreach ($field['rules'] as $rule) {
                $validator = app(static::getClassForValidation($rule));
                if ($validator->validate($value, $key, $field)) {
                    continue;
                } else {
                    $errors[] = $validator->message($key);
                }
            }
        }
        if (!empty($errors))
            throw new ValidationException(json_encode($errors));

    }
}
