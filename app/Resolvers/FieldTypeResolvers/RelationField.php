<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Data\EntityValueFieldGetData;
use App\Helpers\EntityValueHelper;
use App\Helpers\FormatterHelper;
use App\Services\EntityService;
use App\Services\EntityValueService;

class RelationField implements FieldResolverInterface
{

    public function set($value, $field = null): ?string
    {
        return $value;
    }

    public function get(EntityValueFieldGetData $data): array
    {
        $service = new EntityValueService(EntityService::getByHash($data->field['relateTo']));

        $entity = EntityService::getByHash($data->field['relateTo']);
        $instance = $service->show($data->value);

        if ($data->isFormatted) {
            return [
                'id' =>  $instance->id,
                'value' => FormatterHelper::getShortOutput($instance, $entity->short_output)
            ];
        } else {
            return EntityValueHelper::getFormattedEntityValue($instance, $entity);
        }
    }
}
