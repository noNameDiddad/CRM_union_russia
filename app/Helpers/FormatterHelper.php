<?php

namespace App\Helpers;

use App\Http\Resources\EntityValueResource;
use App\Models\Entity;
use App\Services\EntityValueService;
use MongoDB\Laravel\Eloquent\Model;

class FormatterHelper
{
    private EntityValueService $service;

    public function getFormatted($format)
    {
        $entity = Entity::where('hash', $format->hash)->first();

        $entity_table = "table_" . $format->hash;
        $this->service = new EntityValueService($entity_table);

        return EntityValueResource::collection($this->service->getAllByEntity($entity));
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
