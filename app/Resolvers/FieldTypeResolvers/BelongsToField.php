<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Data\EntityValueFieldGetData;
use App\Helpers\EntityValueHelper;
use App\Helpers\FormatterHelper;
use App\Services\EntityService;
use App\Services\EntityValueService;

class BelongsToField implements FieldResolverInterface
{

    public function set($value, $field = null): ?string
    {
        return $value;
    }

    public function get(EntityValueFieldGetData $data): ?array
    {
        $parentEntity = EntityService::getByHash($data->field['relateTo']);
        $service = new EntityValueService($parentEntity);
        $parent = $service->find($data->value);
        if ($data->isFormatted) {
            return [
                'id' =>  $parent->id,
                'value' => FormatterHelper::getShortOutput($parent, $parentEntity->short_output)
            ];
        } else {
            return EntityValueHelper::getFormattedEntityValue($parent, $parentEntity);
        }
    }
}
