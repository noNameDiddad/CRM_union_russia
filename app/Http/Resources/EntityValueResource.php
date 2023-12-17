<?php

namespace App\Http\Resources;

use App\Data\EntityValueFieldGetData;
use App\Helpers\EntityFieldHelper;
use App\Helpers\EntityValueHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntityValueResource extends JsonResource
{
    public function __construct($resource, private bool $isFormatted = true)
    {
        parent::__construct($resource);
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fields = app(EntityFieldHelper::class)->getFields($this->entity_id, true);
        $response = [
            'id' => $this->id,
            'entity_id' => $this->entity_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        foreach ($fields as $key => $field) {
            if (is_array($this->{$key})) {
                $value = json_encode($this->{$key});
            } else {
                $value = $this->{$key};
            }
            $response[$key] = EntityValueHelper::getValueByField(
                new EntityValueFieldGetData(
                    field: $field,
                    value: $value,
                    currentEntityValue: $this->resource,
                    isFormatted: $this->isFormatted
                )
            );
        }

        return $response;
    }
}
