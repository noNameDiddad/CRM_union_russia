<?php

namespace App\Helpers;

use App\Models\Entity;
use App\Models\EntityValue;
use App\Services\FieldTypeService;

class EntityValueHelper
{
    public static function getFormattedEntityValue(EntityValue$instance, Entity $entity): array
    {
        $fields = app(EntityFieldHelper::class)->getFields($entity->id);
        $response = [
            'id' => $instance->id,
            'entity_id' => $instance->entity_id,
            'created_at' => $instance->created_at,
            'updated_at' => $instance->updated_at,
        ];
        foreach ($fields as $key =>$field) {
            $fieldClass = FieldTypeService::getClassForFieldType($field['type']);
            $response[$key] = app($fieldClass)->get($instance->{$key}, $field, false, $entity);
        }
        return $response;
    }
}
