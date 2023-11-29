<?php

namespace App\Http\Resources;

use App\Helpers\EntityFieldHelper;
use App\Services\FieldTypeService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatisticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fields = app(EntityFieldHelper::class)->getFields(entity_id: $this->entity_id, isStatistic: true);
        $response = [
            'id' => $this->id,
            'entity_id' => $this->entity_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        foreach ($fields as $key =>$field) {
            $fieldClass = FieldTypeService::getClassForFieldType($field['type']);
            $response[$key] = app($fieldClass)->get($this->{$key}, $field);
        }

        return $response;
    }
}
