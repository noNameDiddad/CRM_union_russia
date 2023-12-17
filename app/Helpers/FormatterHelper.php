<?php

namespace App\Helpers;

use App\Http\Resources\EntityValueResource;
use App\Models\Entity;
use App\Services\EntityValueService;
use MongoDB\Laravel\Eloquent\Model;
use Str;

class FormatterHelper
{
    private EntityValueService $service;

    public function getFormatted($format)
    {
        $entity = Entity::where('id', $format->entity_id)->first();

        $this->service = new EntityValueService($entity);

        return EntityValueHelper::getFormattedEntityValues($this->service->getAllByEntity($entity), $entity);
    }

    public static function getShortOutput(Model $instance, $shortOutput): string
    {
        $values = Str::of($shortOutput)
            ->matchAll('/\{(.*?)\}/');

        $editedData = [];
        foreach ($values as $value) {
            $editedData[$value] = $instance[Str::slug($value)];
        }

        $shortOutput = Str::remove(['{', '}'], $shortOutput);

        return strtr($shortOutput, $editedData);

    }
}
