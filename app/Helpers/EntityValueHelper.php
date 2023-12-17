<?php

namespace App\Helpers;

use App\Data\EntityValueFieldGetData;
use App\Models\Entity;
use App\Models\EntityValue;
use App\Services\FieldTypeService;
use Illuminate\Database\Eloquent\Collection;

class EntityValueHelper
{
    public static function getFormattedEntityValue(EntityValue $instance, Entity $entity): array
    {
        $response = [
            'id' => $instance->id,
            'entity_id' => $instance->entity_id,
            'created_at' => $instance->created_at,
            'updated_at' => $instance->updated_at,
        ];
        $fields = app(EntityFieldHelper::class)->getFields($entity->id);
        foreach ($fields as $key => $field) {
            $response[$key] = self::getValueByField(
                new EntityValueFieldGetData(
                    field: $field,
                    value: $instance->{$key},
                    entity: $entity
                )
            );
        }
        return $response;
    }

    public static function getFormattedEntityValues(Collection $instances, Entity $entity): array
    {
        $response = [];
        foreach ($instances as $instance) {
            $responseItem = [
                'id' => $instance->id,
                'entity_id' => $instance->entity_id,
                'created_at' => $instance->created_at,
                'updated_at' => $instance->updated_at,
            ];
            $fields = app(EntityFieldHelper::class)->getFields($entity->id);
            foreach ($fields as $key => $field) {
                if (is_array($instance->{$key})) {
                    $value = json_encode($instance->{$key});
                } else {
                    $value = $instance->{$key};
                }
                $responseItem[$key] = self::getValueByField(
                    new EntityValueFieldGetData(
                        field: $field,
                        value: $value,
                        entity: $entity,
                        currentEntityValue: $instance,
                        isFormatted: false,
                    )
                );
            }
            $response[] = $responseItem;
        }

        return $response;
    }

    public static function getValueByField(EntityValueFieldGetData $data)
    {
        $fieldClass = FieldTypeService::getClassForFieldType($data->field['type']);
        return app($fieldClass)->get($data);
    }
}
