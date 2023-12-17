<?php

namespace App\Resolvers\FieldTypeResolvers;

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

    public function get($value, $field = null, $isFormatted = true, $current_entity = null): ?array
    {
        $parentEntity = EntityService::getByHash($field['relateTo']);
        $service = new EntityValueService($parentEntity);
        $parent = $service->find($value);
        if ($isFormatted) {
            return [
                'id' =>  $parent->id,
                'value' => FormatterHelper::getShortOutput($parent, $parentEntity->short_output)
            ];
        } else {
            return EntityValueHelper::getFormattedEntityValue($parent, $parentEntity);
        }
    }
}
