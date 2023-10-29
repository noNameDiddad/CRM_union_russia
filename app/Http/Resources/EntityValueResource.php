<?php

namespace App\Http\Resources;

use App\Helpers\EntityFieldHelper;
use App\Models\EntityField;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntityValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fields = app(EntityFieldHelper::class)->getFields($this->entity_id);
        $response = [
            'id' => $this->id,
            'entity_id' => $this->entity_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        foreach ($fields as $field) {
            $response[$field] = $this->{$field};
        }

        return $response;
    }
}