<?php

namespace App\Http\Resources;

use App\Data\EntityValueFieldGetData;
use App\Helpers\EntityFieldHelper;
use App\Helpers\EntityValueHelper;
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
            if (is_array($this->{$key})) {
                $value = json_encode($this->{$key});
            } else {
                $value = $this->{$key};
            }
            $response[$key] = EntityValueHelper::getValueByField(
                new EntityValueFieldGetData(
                    field: $field,
                    value: $value,
                )
            );
        }

        return $response;
    }
}
